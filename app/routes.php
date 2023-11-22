<?php

Router::GET("/", "index");
Router::GET("/post", "post");

Router::GET("/dashboard/login", "dashboard/login");
Router::POST("/dashboard/login", "dashboard/login");

Router::GET("/dashboard/signup", "dashboard/signup");
Router::POST("/dashboard/signup", "dashboard/signup");

Router::GET("/dashboard", "dashboard/index");
Router::POST("/dashboard/logout", "dashboard/logout");

Router::GET("/dashboard/create", "dashboard/create");
Router::POST("/dashboard/create", "dashboard/create");

Router::GET("/dashboard/update", "dashboard/update");
Router::POST("/dashboard/update", "dashboard/update");

Router::GET("/dashboard/delete", "dashboard/delete");
Router::POST("/dashboard/delete", "dashboard/delete");

Router::GET("/500", "500");
