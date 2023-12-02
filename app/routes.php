<?php

Router::GET("/", [], "index");
Router::GET("/search", [], "search");
Router::GET("/post/:id", [], "post");

Router::GET("/dashboard/login", ["logged-in"], "dashboard/login");
Router::POST("/dashboard/login", ["logged-in"], "dashboard/login");

Router::GET("/dashboard/signup", ["logged-in"], "dashboard/signup");
Router::POST("/dashboard/signup", ["logged-in"], "dashboard/signup");

Router::GET("/dashboard", ["auth"], "dashboard/index");
Router::POST("/dashboard/logout", ["auth"], "dashboard/logout");

Router::GET("/dashboard/create", ["auth"], "dashboard/create");
Router::POST("/dashboard/create", ["auth"], "dashboard/create");

Router::GET("/dashboard/update", ["auth"], "dashboard/update");
Router::PUT("/dashboard/update", ["auth"], "dashboard/update");

Router::GET("/dashboard/delete", ["auth"], "dashboard/delete");
Router::DELETE("/dashboard/delete", ["auth"], "dashboard/delete");

Router::GET("/500", [], "500");
