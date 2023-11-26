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

            if ($rule == "number") {
                if (!isset($data[$field]) || !is_int(intval($data[$field]))) {
                    return ucfirst($field) . " must be a number";
                }
                continue;
            }

            if ($rule == "float") {
                if (!isset($data[$field]) || !is_float(floatval($data[$field]))) {
                    return ucfirst($field) . " must be a float";
                }
                continue;
            }

            if ($rule == "email") {
                if (!isset($data[$field]) || !filter_var($data[$field], FILTER_VALIDATE_EMAIL)) {
                    return ucfirst($field) . " must be an email";
                }
                continue;
            }

            throw new Exception("Invalid rule $rule");
        }
    }

    return null;
}
