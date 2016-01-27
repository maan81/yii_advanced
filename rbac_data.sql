
INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', NULL),
('create-branch', '2', NULL);

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, 'Admin can create branches, companies', NULL, NULL, NULL, NULL),
('create-branch', 1, 'allow user to add a branch', NULL, NULL, NULL, NULL),
('create-company', 1, 'allow users to create companies', NULL, NULL, NULL, NULL),
('create-department', 1, 'allow users to create departments', NULL, NULL, NULL, NULL);

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'create-branch'),
('admin', 'create-company');

