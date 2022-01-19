
-- Database: `pen_database`
-- 
-- Table structure for table `brand_info`
--
CREATE TABLE `brand_info` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(250) NOT NULL
);

INSERT INTO `brand_info` (`brand_id`, `brand_name`) VALUES
(1, 'Platinum'),
(2, 'Pilot'),
(3, 'Pelikan'),
(4, 'Lamy'),
(5, 'Diamine');
--
-- Table structure for table `item_info`
--
CREATE TABLE `item_info` (
  `item_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `color` varchar(250) NOT NULL,
  `category` varchar(250) NOT NULL,
  `Name` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL
);
--
-- Indexes for table `brand_info`
--
ALTER TABLE `brand_info`
  ADD PRIMARY KEY (`brand_id`);
--
-- Indexes for table `item_info`
--
ALTER TABLE `item_info`
  ADD PRIMARY KEY (`item_id`);
--
-- AUTO_INCREMENT for table `brand_info`
--
ALTER TABLE `brand_info`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `item_info`
--
ALTER TABLE `item_info`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;
-- 
-- 
-- 
COMMIT;