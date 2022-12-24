<?php
    $id_params = null;
    if (isset($date_id)) {
        $id_params = ['key' => 'date_id', 'value' => $date_id];
    }
    if (isset($idea_id)) {
        $id_params = ['key' => 'idea_id', 'value' => $idea_id];
    }
    if (isset($song_id)) {
        $id_params = ['key' => 'song_id', 'value' => $song_id];
    }
    if (isset($collection_id)) {
        $id_params = ['key' => 'collection_id', 'value' => $collection_id];
    }
?>

<div class="">
    <form action="<?= $this->Url->build(['controller' => 'Files', 'action' => 'upload']) ?>" data-url-edit="<?= $this->Url->build(['controller' => 'Files', 'action' => 'edit']) ?>" class="dropzone" id="bandcakeUpload">
        <?php
            if ($id_params) {
                echo $this->Form->control($id_params['key'], ['type' => 'hidden', 'value' => $id_params['value']]);
            }
            echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => $currentUser['id']]);
            echo $this->Form->control('_csrfToken', ['type' => 'hidden', 'value' => $_csrfToken]);
        ?>
    </form>
</div>
