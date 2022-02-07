CREATE TABLE `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `isCompleted` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `startTime` varchar(255) NOT NULL,
  `endTime` varchar(255) NOT NULL,
  `remind` int(50) NOT NULL,
  `repeat` varchar(255) NOT NULL,
  `color` int(20),
  PRIMARY KEY (`id`)
);



INSERT INTO `tasks`(`title`, `note`, `isCompleted`, `date`, `startTime`, `endTime`, `remind`, `repeat`, `color`) VALUES 
('test2','test2',2,'9/23/2021','11:20','9:30',10,'daily',2);