<?php

// allowing linebreaks, <br>'s, html entities
// auto linking urls
// stripping tags

if ($text) {
    echo $this->Text->autoParagraph(
        $this->Text->autoLink(
            h(
                strip_tags(
                    str_replace(['<br>','<br/>','<br />'], "\n", $text)
                ),
                false
            ),
            ['escape' => false]
        )
    );
}
