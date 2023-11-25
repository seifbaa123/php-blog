<?php

function validate($data, $rules) {
    foreach ($rules as $field => $field_rules) {
        foreach ($field_rules as $rule) {
            switch ($rule) {
                case "required":
                    if (!isset($data[$field]) || $data[$field] == "") {
                        return ucfirst($field) . " Must not be empty";
                    }
                    break;
                default:
                    throw new Exception("Invalid rule $rule");
            }
        }
    }

    return null;
}
