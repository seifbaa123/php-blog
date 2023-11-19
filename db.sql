CREATE TABLE users (
    username VARCHAR(255) PRIMARY KEY,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE posts (
    post_id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    image_url VARCHAR(255),
    content TEXT,
    username VARCHAR(255) NOT NULL,
    FOREIGN KEY (username) REFERENCES users(username) ON UPDATE CASCADE ON DELETE CASCADE
);
