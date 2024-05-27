USE test;

CREATE TABLE `csv_import` (
  `id` BIGINT NOT NULL,
  `name` VARCHAR(20) NOT NULL,
  `surname` VARCHAR(20) NOT NULL,
  `initial` CHAR(2) NOT NULL,
  `age` INT(11) NOT NULL,
  `dob` DATE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `csv_import`
  ADD PRIMARY KEY (`id`);
