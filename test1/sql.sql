USE steve_devprox;

CREATE TABLE `user` (
  `id` BIGINT NOT NULL,
  `name` VARCHAR(20) NOT NULL,
  `identity_no` VARCHAR(13) NOT NULL UNIQUE,
  `surname` VARCHAR(20) NOT NULL,
  `dob` DATE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);