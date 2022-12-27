<?php

namespace App\Model\Entity;

use Cake\Mailer\Email;
use Cake\ORM\Entity;

/**
 * LocationsMail Entity
 *
 * @property int $location_id
 * @property int $mail_id
 * @property string|null $email
 * @property string|null $subject
 * @property string|null $text
 * @property \Cake\I18n\FrozenTime|null $sent
 *
 * @property \App\Model\Entity\Location $location
 * @property \App\Model\Entity\Mail $mail
 */
class LocationsMail extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'email' => true,
        'subject' => true,
        'text' => true,
        'sent' => true,
        'location' => true,
        'mail' => true,
    ];

    public function send()
    {
        $deliveryProfile = 'external';
        $config = Email::getConfig($deliveryProfile);
        if (empty($config) || empty($config['from'])) {
            throw new \Exception('Missing \'' . $deliveryProfile . '\' from address in config!');
        }
        $from = $config['from'];

        $email = new Email(['template' => 'markdown', 'layout' => 'default']);
        $email->viewBuilder()->addHelpers(['Tanuck/Markdown.Markdown']);
        $email->setTransport('default')
            ->setEmailFormat('html')
            ->setTo($this->email)
            ->setFrom($from)
            ->setSubject($this->subject)
            ->send($this->text);
    }
}
