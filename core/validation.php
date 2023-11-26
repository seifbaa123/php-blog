<?php

function validate($data, $rules) {
    foreach ($rules as $field => $field_rules) {
        foreach ($field_rules as $rule) {
            if ($rule == "required") {
                if (!isset($data[$field]) || $data[$field] == "") {
                    return ucfirst($field) . " must not be empty";
                }
                continue;
            }

            if (!isset($data[$field])) return;

            if ($rule == "number") {
                if (!is_int(intval($data[$field]))) {
                    return ucfirst($field) . " must be a number";
                }
                continue;
            }

            if ($rule == "float") {
                if (!is_float(floatval($data[$field]))) {
                    return ucfirst($field) . " must be a float";
                }
                continue;
            }

            if ($rule == "email") {
                if (!filter_var($data[$field], FILTER_VALIDATE_EMAIL)) {
                    return ucfirst($field) . " must be an email";
                }
                continue;
            }

            if (strpos($rule, "regex:") === 0) {
                $regex = substr($rule, 6);
                if (!preg_match($regex, $data[$field])) {
                    return "Invalid value on field " . ucfirst($field);
                }
                continue;
            }

            if (strpos($rule, "max:") === 0) {
                $max_length = intval(substr($rule, 4));
                if (strlen($data[$field]) > $max_length) {
                    return ucfirst($field) . " max length is $max_length";
                }
                continue;
            }

            if (strpos($rule, "min:") === 0) {
                $min_length = intval(substr($rule, 4));
                if (strlen($data[$field]) < $min_length) {
                    return ucfirst($field) . " min length is $min_length";
                }
                continue;
            }

            if (strpos($rule, "len:") === 0) {
                $length = intval(substr($rule, 4));
                if (strlen($data[$field]) != $length) {
                    return ucfirst($field) . " length must be $length";
                }
                continue;
            }

            throw new Exception("Invalid rule $rule");
        }
    }

    return null;
}
