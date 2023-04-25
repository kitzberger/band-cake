<?php

// allowing linebreaks, <br>'s, html entities
// auto linking urls
// stripping tags

if ($text) {
    if ($markdown ?? false) {
        echo '<div class="markdown">';
        echo $this->Markdown->transform($text);
        echo '</div>';
    } else {
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
}
