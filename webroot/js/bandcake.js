Dropzone.options.bandcakeUpload = {
  init: function () {
    this.on('addedfile', function (file) { console.dir('Added file.') })
    this.on('success', function (file, response) {
      if (response !== null) {
        if (undefined === response.file) {
          console.error('No file property in response ;-/')
          return
        }
        if (undefined === response.suggestions) {
          console.error('No suggestions property in response ;-/')
          return
        }
        if (undefined === response.suggestions.songs) {
          console.error('No suggestions.songs property in response ;-/')
          return
        }

        // console.log('Here\'s some songs that this file might belong to:');
        // console.dir(response.suggestions.songs);
        const select = jQuery('<select id="file-song-select-' + response.file + '" style="height: 2em; padding: 2px;" />')
        select.append('<option />')
        jQuery.each(response.suggestions.songs, function (key, song) {
          select.append('<option value="' + song.id + '">' + song.title + '</option>')
        })
        select.on('change', function () {
          // console.log('Selected song ' + this.value + ' for file ' + file);
          jQuery(this).closest('.dz-preview').find('.dz-image').css('background', 'inherit')
          postEditFile(response.file, { song_id: this.value }, function () {
            jQuery('#file-song-select-' + response.file).closest('.dz-preview').find('.dz-image').css('background', '#c0ffc0')
          })
        })
        jQuery(file.previewElement).find('.dz-details').append(select)
      }
    })
  }
}

$(document).ready(function () {
  // console.log('init_calendar()');
  init_calendar()
  // console.log('init_datefilters()');
  init_datefilters()
  // console.log('init_selectize()');
  init_selectize()
  // console.log('init_votes()');
  // init_votes();
  // console.log('init_audioplayer()');
  init_audioplayer()
  // console.log('init_comments()');
  init_comments()
  // console.log('init_foundation()');
  init_foundation()
})

function changeDateFields () {
  // console.log('changeDateFields() called!')
  $('input.date').each(function (index) {
    let date = this.value
    const type = $(this).attr('type')

    if (type === 'datetime-local') {
      // console.log('change from datetime-local to date')
      this.type = 'date'
      if (date) {
        date = date.substring(0, 10)
        this.value = date
      }
    } else {
      // console.log('change from date to datetime-local')
      this.type = 'datetime-local'
      if (date) {
        date = date + ' 00:00'
        this.value = date
      }
    }
  })
}

function init_foundation () {
  $(document).foundation()
}

function vote (el, value) {
  ul = $(el).closest('ul')
  url = ul.data('url-vote')
  related_to = ul.data('related-to').split(':')
  user_id = ul.data('user-id')

  if (related_to[0] == 'date') { data = { date_id: related_to[1], user_id, vote: value } }
  if (related_to[0] == 'idea') { data = { idea_id: related_to[1], user_id, vote: value } }

  $.ajax({
    type: 'POST',
    url,
    headers: {
      'X-CSRF-Token': ul.data('csrf-token')
    },
    data,
    success: function (data, textStatus, jqXHR) {
      if (jqXHR.status == 200) {
        console.log('New vote_id: ' + data.vote.id)
        // console.dir(jqXHR);
        myVote = $('#my-vote')
        myVote.removeClass('success alert secondary')

        if (data.vote.vote == 1) {
          myVote.addClass('success')
        }
        if (data.vote.vote == -1) {
          myVote.addClass('alert')
        }
        if (data.vote.vote == 0) {
          myVote.addClass('secondary')
        }
      }
    },
    error: function (jqXHR) {
      if (jqXHR.status !== 200) {
        alert(jqXHR.statusText + '\n\n' + jqXHR.responseJSON.message)
      }
      console.dir(jqXHR)
    },
    dataType: 'json'
  })
}

function setVersion (el, collection_id, song_id, version_id) {
  ul = $(el).closest('ul')
  url = ul.data('url-set-version')

  $.ajax({
    type: 'POST',
    url,
    headers: {
      'X-CSRF-Token': ul.data('csrf-token')
    },
    data: {
      collection_id,
      song_id,
      song_version_id: version_id
    },
    success: function (data, textStatus, jqXHR) {
      if (jqXHR.status == 200) {
        const songId = data.collectionSong.song_id
        const versionId = data.collectionSong.song_version_id
        const versionTitle = $('#song-version-' + versionId).text()
        // console.log('New song_version_id: ' + versionId);
        // console.log('New song_version_title: ' + versionTitle);
        $('#song-' + songId + '-version-title').text(versionTitle)
        if (versionId === null) {
          $('#song-' + songId + '-version-title').parent().addClass('secondary')
        } else {
          $('#song-' + songId + '-version-title').parent().removeClass('secondary')
        }
      }
    },
    error: function (jqXHR) {
      if (jqXHR.status !== 200) {
        alert(jqXHR.statusText + '\n\n' + jqXHR.responseJSON.message)
      }
      console.dir(jqXHR)
    },
    dataType: 'json'
  })
}

function init_calendar () {
  // prepare draggable events
  $('#external-events .fc-event').each(function () {
    // store data so the calendar knows to render an event upon drop
    $(this).data('event-template', {
      title: $.trim($(this).text()), // use the element's text as the event title
      start: $(this).data('start-time'),
      end: $(this).data('stop-time'),
      user: $('#calendar').data('current-user'),
      // editable: true,
      stick: true // maintain when user navigates (see docs on the renderEvent method)
    })

    // make the event draggable using jQuery UI
    $(this).draggable({
      zIndex: 999,
      revert: true, // will cause the event to go back to its
      revertDuration: 0 //  original position after the drag
    })
  })

  $('#calendar').fullCalendar({
    lang: 'de',
    timeFormat: '(HH:mm)',
    weekNumbers: true,
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek' // 'agendaDay'
    },
    height: 'auto',
    selectable: true,
    selectHelper: true,
    select: function (start, end) {
      console.dir('select')

      const title = prompt('Event Title:')
      if (title) {
        const event = prepareNewEvent(this)
        const eventId = event.id
        event.title = title
        event.start = start
        event.end = end
        date = $('#calendar').fullCalendar('renderEvent', event, true) // stick? = true

        data = prepareNewDatePayload(this, date)

        postNewDate(data, eventId)
      }
      $('#calendar').fullCalendar('unselect')
    },
    droppable: true,
    drop: function (date, dropEvent, dropItem, dropTarget) {
      console.log('drop')

      const event = prepareNewEvent(this, date)
      const eventId = event.id

      // render the event on the calendar
      // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
      $('#calendar').fullCalendar('renderEvent', event, true)

      data = prepareNewDatePayload(this, date)

      postNewDate(data, eventId)
    },
    eventDrop: function (date, delta, x, dropEvent) {
      console.dir('eventDrop')
    },
    events: $('#calendar').data('events')
  })
}

function prepareNewEvent (cal, date) {
  let event = {}
  event.id = Math.random().toString(36).substr(2, 10)
  event.className = 'unsafed-event'

  if (typeof date === 'object') {
    // console.dir(date);
    // console.dir(date._d);
    // console.dir(date._d.toUTCString());
    // console.dir(dropEvent);
    // console.dir(dropItem);
    // console.dir(dropTarget);
    // console.dir(jQuery(this).data('event-data'));

    const eventTemplate = $(cal).data('event-template')
    // console.dir(eventTemplate);

    // we need to copy it, so that multiple events don't have a reference to the same object
    event = $.extend(event, eventTemplate)
    event.start = moment(date._d.toDateString() + ' ' + event.start)
    event.end = moment(date._d.toDateString() + ' ' + event.end)
  }

  return event
}

function prepareNewDatePayload (cal, date) {
  const eventTemplate = $(cal).data('event-template')

  if (typeof eventTemplate === 'object') {
    data = {
      user_id: eventTemplate.user,
      title: eventTemplate.title,
      begin: date._d.toMyDateString() + ' ' + eventTemplate.start.substring(0, 2) + ':' + eventTemplate.start.substring(3, 5),
      end: date._d.toMyDateString() + ' ' + eventTemplate.end.substring(0, 2) + ':' + eventTemplate.end.substring(3, 5),
      is_fullday: 0,
      status: 0,
      text: ''
    }
  } else {
    date = date[0]
    data = {
      user_id: $('#calendar').data('current-user'),
      title: date.title,
      begin: date.start._d.toMyDateString() + ' 00:00',
      end: date.start._d.toMyDateString() + ' 23:59',
      is_fullday: 1,
      status: 0,
      text: ''
    }
  }

  return data
}

function postNewDate (data, eventId) {
  $.ajax({
    type: 'POST',
    url: $('#calendar').data('url-add'),
    headers: {
      'X-CSRF-Token': $('#calendar').data('csrf-token')
    },
    data,
    success: function (data, textStatus, jqXHR) {
      if (jqXHR.status == 200) {
        console.log('New date_id: ' + data.date.id)
        // console.dir(jqXHR);

        // get event
        let event = $('#calendar').fullCalendar('clientEvents', eventId)
        if (event.length) {
          // set url and stop the spinner
          event = event[0]
          event.id = data.date.id
          event.url = $('#calendar').data('url-view') + '/' + data.date.id
          event.className = ''

          // save event
          $('#calendar').fullCalendar('updateEvent', event)
        }
      }
    },
    dataType: 'json'
  })
}

function init_comments () {
  const commentTable = $('table.comments')
  const togglePanel = commentTable.find('.toggle-old-ones')
  const showOldOnes = commentTable.find('.toggle-old-ones a.show-old-ones')
  const hideOldOnes = commentTable.find('.toggle-old-ones a.hide-old-ones')

  let oldComments = commentTable.find('tr.older-than-last-month')
  const newComments = commentTable.find('tr.younger-than-last-month')

  if (newComments.length == 0) {
    // in case there's no new comments, remove the latest from the list of old ones,
    // so it's not gonna be hidden.
    lastOldComment = oldComments.last()
    lastOldComment.removeClass('hide')
    oldComments = oldComments.not(lastOldComment)
  }

  if (oldComments.length > 0) {
    togglePanel.removeClass('hide')
    showOldOnes.on('click', function () {
      oldComments.removeClass('hide')
      showOldOnes.addClass('hide')
      hideOldOnes.removeClass('hide')
    })
    hideOldOnes.on('click', function () {
      oldComments.addClass('hide')
      showOldOnes.removeClass('hide')
      hideOldOnes.addClass('hide')
    })
  }
}

function init_selectize () {
  $('select[multiple]').selectize({
    plugins: ['remove_button', 'drag_drop']
  })
}

if (!Date.prototype.toMyDateString) {
  (function () {
    function pad (number) {
      if (number < 10) {
        return '0' + number
      }
      return number
    }

    Date.prototype.toMyDateString = function () {
      return this.getUTCFullYear() +
  '-' + pad(this.getUTCMonth() + 1) +
  '-' + pad(this.getUTCDate())
    }
  }())
}

let wavesurfer

function init_waveform () {
  if (undefined === wavesurfer) {
    wavesurfer = WaveSurfer.create({
      // https://wavesurfer-js.org/docs/options.html
      container: '#audioplayer .waveform',
      waveColor: 'gray',
      progressColor: 'blue',
      height: 50,
      normalize: false,
      splitChannels: false,
      interact: true, // mouse interaction
      backend: 'MediaElement',
      plugins: [
        WaveSurfer.cursor.create({
          showTime: true,
          opacity: 1,
          customShowTimeStyle: {
            'background-color': '#000',
            color: '#fff',
            padding: '2px',
            'font-size': '10px'
          }
        }),
        WaveSurfer.timeline.create({
          container: '#audioplayer .timeline'
        }),
        WaveSurfer.regions.create({
        })
      ]
    })
    wavesurfer.on('error', function (e) {
      console.warn(e)
    })
    wavesurfer.on('ready', function () {
      wavesurfer.play()
    })
    $('[data-action="waveform-playPause"]').on('click', function () {
      wavesurfer.playPause()
    })
    $('[data-action="waveform-hide"]').on('click', function () {
      wavesurfer.cancelAjax()
      wavesurfer.stop()
      $('#audioplayer').hide()
    })
    $('body').on('keydown', function (event) {
      // console.log($(':focus').length);
      // console.log($(':focus'));
      if ($(':focus').length > 0) {
        return
      }
      // console.log(event.keyCode);
      if (event.keyCode == 27) {
        $('[data-action="waveform-hide"]:visible').trigger('click')
      }
      if (event.keyCode == 32) {
        event.preventDefault()
        $('[data-action="waveform-playPause"]:visible').trigger('click')
      }
    })
  }
  $('#audioplayer').show()
}

function play_in_waveform (el) {
  init_waveform()

  const data = $(el).data('audioplayer')

  $('#audioplayer .topbar .title').html(data.title)
  $('#audioplayer .topbar .url').attr('href', data.url)

  wavesurfer.load(data.url)

  // Remove old regions
  wavesurfer.clearRegions()
  $('#audioplayer .toolbar .regions').html('')

  // Add new regions
  for (region of data.regions) {
    // console.log(region)
    wavesurfer.addRegion(region)
    const button = '<a class="button" onclick="play_region(' + region.id + ')">' + region.title + '</a>'
    $('#audioplayer .toolbar .regions').append(button)
  }
}

function play_region (regionId) {
  wavesurfer.regions.list[regionId].play()
}

function init_audioplayer () {
  const audioTags = jQuery('.audio-player audio')
  audioTags.bind('ended', function () {
    current = jQuery(this).closest('.item-audio')
    next = current.nextAll('.item-audio').find('audio')
    if (next[0]) {
      console.log('Playing next song.')
      next[0].play()
    } else {
      console.log('No further songs to play.')
    }
  })
}

function init_datefilters () {
  $('.button[data-status]').bind('click', function (event) {
    event.preventDefault()
    el = $(event.target)

    if (el.hasClass('active')) {
      el.removeClass('active')
    } else {
      el.addClass('active')
    }
    filterDates()
  })
}

function filterDates () {
  allStateToggles = $('[data-status]')

  if (allStateToggles.hasClass('active')) {
    allStateToggles.each(function () {
      toggle = $(this)
      status = toggle.data('status')
      if (toggle.hasClass('active')) {
        $('table.dates tr.status' + status).show()
      } else {
        $('table.dates tr.status' + status).hide()
      }
    })
  } else {
    $('table.dates tr.status' + status).show()
  }
}

function postEditFile (fileId, data, callback) {
  $.ajax({
    type: 'POST',
    url: $('#bandcakeUpload').data('url-edit') + '/' + fileId,
    headers: {
      'X-CSRF-Token': $('#bandcakeUpload #csrftoken').val()
    },
    data,
    success: function (data, textStatus, jqXHR) {
      if (jqXHR.status == 200) {
        // console.dir('Data: ' + data);
        // console.dir(jqXHR);
      }
      callback()
    },
    dataType: 'json'
  })
}
