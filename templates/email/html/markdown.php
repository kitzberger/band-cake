<?php

echo $this->Text->autoLink(
    $this->Markdown->transform($content),
    ['escape' => false]
);
