<?php

class Mail
{

    protected $name;
    protected $values = array();

    protected function __construct($name) {
        $this->name = $name;
    }

	static function get($name)
    {
        return new static($name);
    }

    public function setValues(array $values)
    {
        foreach ($values as $key => $value)
        {
            $this->values['{$'.$key.'}'] = $value;
        }
        return $this;
    }

    public function send($to)
    {
        $mail = $this->getMail($this->name);
        $subject = $this->replaceValues($mail['dtsubject'], $this->values);
        $content = $this->replaceValues($mail['dtcontent'], $this->values);

        $mailer = new \PHPMailer();
        $mailer->setFrom(\Config::MAIL_FROM, \Config::MAIL_FROM_NAME);
        $mailer->addAddress($to);
        $mailer->isHTML(true);
        $mailer->Subject = $subject;
        $mailer->Body = $content;
        $mailer->send();

        return $this;
    }

    public function replaceValues($text, array $values)
    {
        return str_replace(array_keys($values), array_values($values), $text);
    }

    public function getMail($name)
    {
        $db = \DB::getInstance();
        $result = $db->execute('
            SELECT dtsubject, dtcontent
            FROM tblfitness_mail_template
            WHERE dtname = :name
        ', array(
            'name' => $name
        ));
        return $result->fetch();
    }

}
