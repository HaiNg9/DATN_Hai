<?php

class CreateDatabase extends CI_Controller
{

    public function index()
    {
        $this->load->library('migration');

        if ($this->migration->current() === FALSE)
        {
            show_error($this->migration->error_string());
        }
        else {
            echo "Create migrate success!!!";
        }
        $this->createSeed();
    }

    private function createSeed()
    {
        $this->createRolesData();
        $this->createUsersData();
        $this->createHomesData();
        $this->createCategoriesData();
        $this->createTypesData();
        $this->createPostsData();
        $this->createCommentsData();
        $this->createPostionsData();
        $this->createEmployeesData();
    }

    private function createUsersData()
    {
        $roles = '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,';
        $roles .= '41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60';
        $data = [
			[
                'display_name' => 'Tài khoản quản trị',
                'password' => password_hash('123123', PASSWORD_BCRYPT),
                'email' => 'admin@gmail.com',
                'role' => 'ADMIN',
                'role_number' => $roles, 
                'img' => 'default.png'
            ],
            [
				'display_name' => 'Tài khoản cấp cao',
                'email' => 'user@gmail.com',
                'password' => password_hash('123123', PASSWORD_BCRYPT),
                'role' => 'USER',
                'role_number' => '',
                'img' => 'default.png'
			]
		];

        $this->db->insert_batch('users', $data);
    }

    public function createRolesData()
    {
        $data = [
			[
                'name' => 'admin/home',
                'display_name' => 'Trang chủ'
            ],
            [
                'name' => 'admin/dashboard/edit',
                'display_name' => 'Tải dữ liệu thống kê'
            ],
			[
                'name' => 'admin/user/list',
                'display_name' => 'Giao diện danh sách tài khoản'
            ],
            [
                'name' => 'admin/user/add',
                'display_name' => 'Giao diện thêm tài khoản'
			],
			[
                'name' => 'admin/user/edit',
                'display_name' => 'Giao diện sửa tài khoản'
            ],
            [
                'name' => 'admin/user/update',
                'display_name' => 'Thay đổi thông tin tài khoản'
            ],
            [
                'name' => 'admin/user/delete',
                'display_name' => 'Xóa tài khoản'
            ],
            [
                'name' => 'admin/user/create',
                'display_name' => 'Thêm dữ liệu tài khoản'
            ],
            [
                'name' => 'admin/user/role',
                'display_name' => 'Chỉnh sửa quyền tài khoản'
            ],
            [
                'name' => 'admin/user/editRoleNumber',
                'display_name' => 'Giao diện thay đổi quyền tài khoản'
            ],
            [
                'name' => 'admin/user/updateRoleNumber',
                'display_name' => 'Thay đổi danh sách quyền tài khoản'
            ],
            [
                'name' => 'admin/user/editRoleName',
                'display_name' => 'Giao diện thay đổi tên quyền tài khoản'
            ],
            [
                'name' => 'admin/user/updateRoleName',
                'display_name' => 'Thay đổi dữ liệu tên quyền tài khoản'
            ],
            [
                'name' => 'admin/category/list',
                'display_name' => 'Giao diện danh sách thể loại tin tức'
            ],
            [
                'name' => 'admin/category/add',
                'display_name' => 'Giao diện thêm thể loại tin tức'
            ],
            [
                'name' => 'admin/category/create',
                'display_name' => 'Thêm dữ liệu thể loại tin tức'
            ],
			[
                'name' => 'admin/category/edit',
                'display_name' => 'Giao diện sửa thể loại tin tức'
            ],
            [
                'name' => 'admin/category/update',
                'display_name' => 'Thay đổi thông tin thể loại tin tức'
            ],
            [
                'name' => 'admin/category/delete',
                'display_name' => 'Xóa thể loại tin tức'
            ],
            [
                'name' => 'admin/type/list',
                'display_name' => 'Giao diện danh sách loại tin tức'
            ],
            [
                'name' => 'admin/type/add',
                'display_name' => 'Giao diện thêm loại tin tức'
            ],
            [
                'name' => 'admin/type/create',
                'display_name' => 'Thêm dữ liệu loại tin tức'
            ],
			[
                'name' => 'admin/type/edit',
                'display_name' => 'Giao diện sửa loại tin tức'
            ],
            [
                'name' => 'admin/type/update',
                'display_name' => 'Thay đổi thông tin loại tin tức'
            ],
            [
                'name' => 'admin/type/delete',
                'display_name' => 'Xóa loại tin tức'
            ],
            [
                'name' => 'admin/post/list',
                'display_name' => 'Giao diện danh sách tin tức'
            ],
            [
                'name' => 'admin/post/add',
                'display_name' => 'Giao diện thêm tin tức'
            ],
            [
                'name' => 'admin/post/create',
                'display_name' => 'Thêm dữ liệu tin tức'
            ],
			[
                'name' => 'admin/post/edit',
                'display_name' => 'Giao diện sửa tin tức'
            ],
            [
                'name' => 'admin/post/update',
                'display_name' => 'Thay đổi thông tin tin tức'
            ],
            [
                'name' => 'admin/post/delete',
                'display_name' => 'Xóa tin tức'
            ],
            [
                'name' => 'admin/comment/edit',
                'display_name' => 'Thay đổi khóa bình luận'
            ],
            [
                'name' => 'admin/comment/delete',
                'display_name' => 'Xóa bình luận'
            ],
            [
                'name' => 'admin/position/list',
                'display_name' => 'Giao diện xem danh sách chức vụ'
            ],
            [
                'name' => 'admin/position/update',
                'display_name' => 'Cập nhật dữ liệu danh sách chức vụ'
            ],
            [
                'name' => 'admin/position/delete',
                'display_name' => 'Xóa chức vụ'
            ],
            [
                'name' => 'admin/employee/list',
                'display_name' => 'Giao diện danh sách nhân viên'
            ],
            [
                'name' => 'admin/employee/add',
                'display_name' => 'Giao diện thêm nhân viên'
            ],
            [
                'name' => 'admin/employee/create',
                'display_name' => 'Thêm dữ liệu nhân viên'
            ],
            [
                'name' => 'admin/employee/edit',
                'display_name' => 'Giao diện sửa nhân viên'
            ],
            [
                'name' => 'admin/employee/update',
                'display_name' => 'Cập nhật dữ liệu nhân viên'
            ],
            [
                'name' => 'admin/employee/delete',
                'display_name' => 'Xóa nhân viên'
            ],
            [
                'name' => 'admin/homepage/list',
                'display_name' => 'Cài đặt trang chủ'
            ],
            [
                'name' => 'admin/homepage/update',
                'display_name' => 'Cập nhật thông tin trang chủ'
            ],
            [
                'name' => 'admin/history/list',
                'display_name' => 'Thông tin lịch sử hoạt động'
            ],
            [
                'name' => 'admin/history/update',
                'display_name' => 'Đánh dấu xem toàn bộ thông báo'
            ],
            [
                'name' => 'admin/history/edit',
                'display_name' => 'Xem chi tiết thông báo'
            ],
            [
                'name' => 'admin/history/delete',
                'display_name' => 'Xóa bỏ vĩnh viễn thông báo thông báo'
            ],
            [
                'name' => 'admin/bin/list',
                'display_name' => 'Truy cập dữ liệu thùng rác'
            ],
            [
                'name' => 'admin/bin/edit',
                'display_name' => 'Phục hồi dữ liệu thùng rác'
            ],
            [
                'name' => 'admin/bin/delete',
                'display_name' => 'Xóa bỏ dữ liệu vĩnh viễn'
            ],
            [
                'name' => 'admin/subscribe/list',
                'display_name' => 'Xem danh sách email đăng ký nhận thông báo'
            ],
            [
                'name' => 'admin/subscribe/edit',
                'display_name' => 'Xem thông báo email đăng ký nhận'
            ],
            [
                'name' => 'admin/subscribe/delete',
                'display_name' => 'Xóa email đăng ký nhận thông báo'
            ],
		];

        $this->db->insert_batch('roles', $data);
    }
    
    private function createHomesData()
    {
        $data = [
			[
				'logo' => 'logo_home_page.png',
                'email' => 'info@gmail.com',
                'phone' => '0977-937-827',
                'web_link' => 'sivinews.com'
			]
		];

        $this->db->insert_batch('homes', $data);
    }

    private function createCategoriesData(){
        $data = [
			[
				'name' => 'Bán nhà',
                'created_by' => 2,
			]
		];

        $this->db->insert_batch('categories', $data);
    }

    private function createTypesData(){
        $data = [
			[
                'name' => 'Nhà chung cư',
                'id_category' => 1,
                'created_by' => 2,
			]
		];

        $this->db->insert_batch('types', $data);
    }

    private function createPostsData(){
        $data = [
			[
				'img'          => 'default.png',
                'title'        => 'Tiêu đề bài viết',
                'content'      => 'Nội dung bài viết',
                'like'         => '1',
                'description'  => 'Financial news: A new company is born today at the stock market',
                'id_type'      => 1,
                'id_user'      => 2,
                'created_by'   => 2,
			]
		];

        $this->db->insert_batch('posts', $data);
    }
    
    private function createCommentsData(){
        $data = [
			[
				'content'        => 'Nội dung comment 1',
                'id_user'        => 1,
                'id_post'        => 1
            ],
            [
				'content'        => 'Nội dung comment 2',
                'id_post'        => 1,
                'id_user'        => 1
            ],
            [
				'content'        => 'Nội dung comment 3',
                'id_post'        => 1,
                'id_user'        => 1
            ]
		];

        $this->db->insert_batch('comments', $data);
    }

    private function createPostionsData(){
        $data = [
			[
				'name'        => 'Chức vụ 1',
                'created_by'        => 2,
            ],
            [
				'name'        => 'Chức vụ 2',
                'created_by'        => 2,
            ],
            [
				'name'        => 'Chức vụ 3',
                'created_by'        => 2,
            ]
		];

        $this->db->insert_batch('positions', $data);
    }

    public function createEmployeesData()
    {
        $data = [
			[
				'img'         => 'default.png',
                'name'        => 'Nhân viên 1',
                'id_position' => 1,
                'created_by'  => 2,
            ],
            [
				'img'         => 'default.png',
                'name'        => 'Nhân viên 2',
                'id_position' => 1,
                'created_by'  => 2,
            ],
            [
				'img'         => 'default.png',
                'name'        => 'Nhân viên 3',
                'id_position' => 1,
                'created_by'  => 2,
            ]
		];

        $this->db->insert_batch('employees', $data);
    }
    
}