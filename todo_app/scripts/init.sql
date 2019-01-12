use app;

CREATE TABLE IF NOT EXISTS todos (
    id       INT          NOT NULL AUTO_INCREMENT,
    content  VARCHAR(500) NOT NULL,
    created  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status   ENUM('active', 'completed', 'deleted') NOT NULL,

    PRIMARY KEY (id),
    INDEX (modified, status),
    INDEX (created, status)
);

-- vim: set ft=mysql:
