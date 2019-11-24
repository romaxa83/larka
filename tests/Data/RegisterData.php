<?php

namespace Tests\Data;

class RegisterData
{
    private $data = [
        'login' => 'cubic',
        'password' => 'password',
        'password_confirmation' => 'password',
        'email' => 'cubic@cubic.com',
    ];

    public function get()
    {
        return $this->data;
    }

    public function withoutData($field)
    {
        // присваивает всем поля null
        if($field == 'all'){
            foreach($this->data as $key => $item){
                $this->data[$key] = null;
            }
            return $this->data;
        }

        // в массиве передаеться поле и значение
        if(is_array($field)){
            foreach ($field as $key => $item){
                $this->checkField($key);
                $this->data[$key] = $item;
            }
            return $this->data;
        }

        $this->checkField($field);
        $this->data[$field] = null;

        return $this->data;
    }

    /**
     * @param $field
     */
    private function checkField($field)
    {
        if(!array_key_exists($field, $this->data)){
            throw new \Exception("Ключа - {$field},нет в массиве данных");
        }
    }
}