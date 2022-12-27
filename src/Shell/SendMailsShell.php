<?php

namespace App\Shell;

use Cake\Console\ConsoleOptionParser;
use Cake\Console\Shell;
use Cake\I18n\FrozenTime;

/**
 * SendMails shell command.
 */
class SendMailsShell extends Shell
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('LocationsMails');
    }

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser(): ConsoleOptionParser
    {
        $parser = parent::getOptionParser();
        $parser->addOption(
            'dry-run',
            [
                'help' => 'Don\'t send any mails, only list the mails in the queue.',
                'short' => 'd',
                'boolean' => true,
            ]
        );
        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int Success or error code.
     */
    public function main()
    {
        $dryRun = $this->params['dry-run'] ?? false;

        $options = [
            'conditions' => [
                'LocationsMails.email !=' => '',
                'LocationsMails.subject !=' => '',
                'LocationsMails.sent IS' => null,
            ],
        ];

        $mails = $this->LocationsMails->find('all', $options);
        foreach ($mails as $mail) {
            $this->out('Mail to ' . $mail['email'] . ': ' . $mail['subject']);

            if ($dryRun === false) {
                $mail->send();
                $mail->sent = FrozenTime::now();
                $this->LocationsMails->save($mail);
                $this->out('-> Mark mail as sent on ' . (string)$mail->sent);
            } else {
                $this->out('-> Skip (due to dry-run!)');
            }
        }
    }
}
