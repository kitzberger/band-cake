<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
    <title><?= $this->fetch('title') ?></title>
    <style>
        .inline {
            display: inline-block;
        }
        .inactive {
            cursor: default !important;
        }
        button, .button {
            -webkit-appearance: none;
            -moz-appearance: none;
            border-radius: 0;
            border-style: solid;
            border-width: 0;
            cursor: pointer;
            font-family: "Helvetica Neue",Helvetica,Roboto,Arial,sans-serif;
            font-weight: normal;
            line-height: normal;
            margin: 0 0 1.25rem;
            position: relative;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            padding: 1rem 2rem 1.0625rem 2rem;
            font-size: 1rem;
            background-color: #008CBA;
            border-color: #007095;
            color: #fff;
            transition: background-color 300ms ease-out;
        }
        button.alert, .button.alert {
            background-color: #f04124;
            border-color: #cf2a0e;
            color: #fff;
        }
        button.success, .button.success {
            background-color: #43AC6A;
            border-color: #368a55;
            color: #fff;
        }
        button.secondary, .button.secondary {
            background-color: #e7e7e7;
            border-color: #b9b9b9;
            color: #333;
        }

        h2, h3, p { padding-left: 5px; padding-right: 5px; }
        table { width: 100%; }
        table th,
        table td { vertical-align: top; text-align: left; padding: 5px 10px 10px 5px; }
        table tr.even td { background: #f2f2f2; }
        table.logs td.diff { width: 50%; }
        del { color: red; }
        ins { color: green; text-decoration: none; }
    </style>
</head>
<body>
    <?= $this->fetch('content') ?>
</body>
</html>
