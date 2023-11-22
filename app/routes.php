<?php

Router::GET("/", "index");
Router::GET("/post", "post");

Router::GET("/dashboard/login", "dashboard/login", ["logged-in"]);
Router::POST("/dashboard/login", "dashboard/login", ["logged-in"]);

Router::GET("/dashboard/signup", "dashboard/signup", ["logged-in"]);
Router::POST("/dashboard/signup", "dashboard/signup", ["logged-in"]);

Router::GET("/dashboard", "dashboard/index", ["auth"]);
Router::POST("/dashboard/logout", "dashboard/logout", ["auth"]);

Router::GET("/dashboard/create", "dashboard/create", ["auth"]);
Router::POST("/dashboard/create", "dashboard/create", ["auth"]);

Router::GET("/dashboard/update", "dashboard/update", ["auth"]);
Router::POST("/dashboard/update", "dashboard/update", ["auth"]);

Router::GET("/dashboard/delete", "dashboard/delete", ["auth"]);
Router::POST("/dashboard/delete", "dashboard/delete", ["auth"]);

Router::GET("/500", "500");
