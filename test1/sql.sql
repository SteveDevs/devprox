USE test;

CREATE TABLE `user` (
  `id` BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(20) NOT NULL,
  `identity_no` VARCHAR(13) NOT NULL UNIQUE,
  `surname` VARCHAR(20) NOT NULL,
  `dob` DATE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
