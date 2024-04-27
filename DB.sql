create table Users (
    Id int primary key auto_increment,
    fullname varchar(100) not null,
    email varchar(150) not null,
    username varchar(100) not null,
    mypassword varchar(150) not null,
    image varchar(150) not null,
    create_at Timestamp
);
CREATE TABLE `admins` (
    `id` int(3) auto_increment primary key,
    `adminname` varchar(200) NOT NULL,
    `email` varchar(200) NOT NULL,
    `mypassword` varchar(200) NOT NULL,
    `created_at` timestamp
);
--
-- Dumping data for table `admins`
INSERT INTO `admins` (
        `id`,
        `adminname`,
        `email`,
        `mypassword`,
        `created_at`
    )
VALUES (
        1,
        'admin.first',
        'admin.first@gmail.com',
        '$2y$10$EvaSGxbY90rOqk0fkdvmoOJToy5s4oVfZlJzph..4vqQT4jpPCDHS',
        '2022-12-12 11:33:37'
    ),
    (
        2,
        'admin.second',
        'admin.second@gmail.com',
        '$2y$10$nEx02PaHMHQaKPoosW8nQeMunZopWa7K.UAh6onmxgw4GldIEYDG.',
        '2022-12-12 12:10:05'
    );
-- --------------------------------------------------------
--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
    `id` int primary key auto_increment,
    `pro_id` int(3) NOT NULL,
    `pro_title` varchar(200) NOT NULL,
    `pro_image` varchar(200) NOT NULL,
    `pro_price` int(10) NOT NULL,
    `pro_qty` int(10) NOT NULL,
    `pro_subtotal` int(10) NOT NULL,
    `user_id` int(3) NOT NULL,
    `created_at` timestamp DEFAULT current_timestamp()
);
-- --------------------------------------------------------
--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
    `id` int(3) NOT NULL primary key,
    `name` varchar(200) NOT NULL,
    `image` varchar(200) NOT NULL,
    `icon` varchar(200) NOT NULL,
    `description` varchar(200) NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp()
);
--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (
        `id`,
        `name`,
        `image`,
        `icon`,
        `description`,
        `created_at`
    )
VALUES (
        1,
        'ဟင်းသီးဟင်းရွက်',
        'vegetables.jpg',
        'bistro-carrot',
        'Rapidiously foster exceptional alignments for plug-and-play interfaces. Progressively expedite cross-platform core competencies vis-a-vis cross-media',
        '2022-12-07 12:11:04'
    ),
    (
        2,
        'အသား',
        'meats.jpg',
        'bistro-roast-leg',
        'Rapidiously foster exceptional alignments for plug-and-play interfaces. Progressively expedite cross-platform core competencies vis-a-vis cross-media',
        '2022-12-07 12:11:04'
    ),
    (
        3,
        'ငါး',
        'fish.jpg',
        'bistro-fish-1',
        'Continually reintermediate impactful web-readiness with enabled catalysts for change. Globally synthesize go forward information for sustainable ',
        '2022-12-07 13:15:14'
    ),
    (
        4,
        'အသီးအနှံ',
        'fruits.jpg',
        'bistro-apple',
        'Continually reintermediate impactful web-readiness with enabled catalysts for change. Globally synthesize go forward information for sustainable ',
        '2022-12-07 13:15:14'
    );
-- --------------------------------------------------------
--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
    `id` int primary key auto_increment,
    `name` varchar(200) NOT NULL,
    `lname` varchar(200) NOT NULL,
    `address` varchar(200) NOT NULL,
    `city` varchar(200) NOT NULL,
    `phone_number` varchar(30) NOT NULL,
    `order_notes` text NOT NULL,
    `status` varchar(200) NOT NULL DEFAULT 'sent to admins',
    `price` int(20) NOT NULL,
    `user_id` int(10) NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp()
);
--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (
        `id`,
        `name`,
        `lname`,
        `company_name`,
        `address`,
        `city`,
        `country`,
        `zip_code`,
        `email`,
        `phone_number`,
        `order_notes`,
        `status`,
        `price`,
        `user_id`,
        `created_at`
    )
VALUES (
        5,
        'Mohamed',
        'Hassan',
        'web coding',
        'Appropriately recaptiualize professional metrics vis-a-vis reliable core competencies. Monotonectally initiate performance based models after real-time',
        'Cairo',
        'Egypt',
        3232332,
        'user1@user.com',
        223321323,
        'Appropriately recaptiualize professional metrics vis-a-vis reliable core competencies. Monotonectally initiate performance based models after real-time',
        'sent to admins',
        110,
        1,
        '2022-12-14 12:47:47'
    );
CREATE TABLE `products` (
    `id` int(3) NOT NULL,
    `title` varchar(200) NOT NULL,
    `description` text NOT NULL,
    `price` varchar(10) NOT NULL,
    `quantity` int(3) NOT NULL DEFAULT 1,
    `image` varchar(200) NOT NULL,
    `exp_date` varchar(200) NOT NULL,
    `category_id` int(3) NOT NULL,
    `status` int(1) NOT NULL DEFAULT 1,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    Foreign key (category_id) references categories(id)
);
INSERT INTO `products` (
        `id`,
        `title`,
        `description`,
        `price`,
        `quantity`,
        `image`,
        `exp_date`,
        `category_id`,
        `status`,
        `created_at`
    )
VALUES (
        1,
        'ဟင်းသီးဟင်းရွက်များ',
        'Collaboratively extend collaborative ROI after client-centric metrics. Energistically enhance scalable scenarios whereas long-term high-impact architectures. Uniquely formulate leading-edge experiences through installed base technology. Quickly pontificate focused data after cutting-edge',
        '1000',
        1,
        'vegetables.jpg',
        '2024-6-31',
        1,
        1,
        '2024-6-20 14:07:43'
    ),
    (
        2,
        'အသားများ',
        'Enthusiastically enable competitive e-business rather than efficient total linkage. Professionally predominate superior infrastructures with unique technology. Assertively plagiarize premium communities vis-a-vis professional channels. ',
        '4000',
        1,
        'meats.jpg',
        '2024-6-31',
        2,
        1,
        '2024-6-20 14:07:43'
    ),
    (
        3,
        'ငါးများ',
        'Interactively predominate cross-media web services and leveraged e-tailers. Authoritatively drive visionary leadership without resource maximizing value. Credibly transform an expanded array of architectures for compelling results. ',
        '5000',
        1,
        'fish.jpg',
        '2024-6-31',
        3,
        1,
        '2024-6-20 14:07:43'
    ),
    (
        4,
        'အသီးအနှံများ',
        'Uniquely incentivize real-time services through e-business intellectual capital. Dramatically recaptiualize global internal or \"organic\" sources after timely schemas. Progressively network cross ',
        '2500',
        1,
        'fruits.jpg',
        '2024-6-31',
        4,
        1,
        '2024-6-20 14:07:43'
    ),
    (
        5,
        'အသားမုန့်များ',
        'Quickly administrate viral best practices without out-of-the-box benefits. Competently formulate bleeding-edge metrics without flexible niche markets. Conveniently customize leveraged networks via orthogonal convergence. Appropriately ',
        '3000',
        1,
        'meats.jpg',
        '2024-6-31',
        2,
        1,
        '2024-6-20 14:07:43'
    ),
    (
        6,
        'ခရမ်းချဉ်သီး',
        'Globally coordinate cross-media e-tailers vis-a-vis quality methodologies. Efficiently parallel task competitive synergy after ubiquitous metrics. Efficiently synthesize cost effective core ',
        '1000',
        1,
        'vegetables.jpg',
        '2024-6-31',
        1,
        1,
        '2024-6-20 14:07:43'
    );
--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
ADD PRIMARY KEY (`id`);
--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
ADD PRIMARY KEY (`id`);
--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
ADD PRIMARY KEY (`id`);
--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
ADD PRIMARY KEY (`id`);
--
-- Indexes for table `products`
--
ALTER TABLE `products`
ADD PRIMARY KEY (`id`);
--
-- Indexes for table `users`
--
ALTER TABLE `Users`
ADD PRIMARY KEY (`id`);
--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 3;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 38;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 12;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 6;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 53;
COMMIT;