<?php

class Menu extends CI_Controller
{
    private $_data = array();

    public function __construct()
    {
        parent::__construct();
        $this->_data['page'] = 'menus';
        $this->_data['dept_id'] = 6;
        $this->_data['title'] = 'Restaurants and Menus - Kathmandu Hotel';
    }

    public function index()
    {
        check_login(2,$this->_data['dept_id']);


        $this->_data['restaurants'] = $this->menu_m->getRestaurants();

        $this->load->view('header', $this->_data);
        $this->load->view('menu/list', $this->_data);
        $this->load->view('footer');
    }

    public function view()
    {
        check_login(2,$this->_data['dept_id']);

        $restaurant = $this->uri->segment(3);
        if (!trim($restaurant)) redirect(base_url('menu'));
        $restaurant = trim(str_replace('-', ' ', $restaurant));

        $this->_data['restaurant'] = $this->menu_m->getRestaurantDetail($restaurant);
        $this->_data['menu'] = $this->menu_m->getCategoriesAndMenus($restaurant);

        $this->load->view('header', $this->_data);
        $this->load->view('menu/view');
        $this->load->view('footer');

    }

    public function addCategory()
    {
        check_login(2,$this->_data['dept_id']);

        $restaurant = $this->uri->segment(3);
        if (!trim($restaurant)) redirect(base_url('menu'));
        $restaurant = trim(str_replace('-', ' ', $restaurant));

        if ($this->input->post('create')) {
            $file_name = strtolower(trim(str_replace(' ', '-', $restaurant)) . '-' . trim(str_replace(' ', '-', $this->input->post('name'))));
            $upload = $this->uploadImage('uploads/categories/', $file_name);
            $data = [
                'restaurant_name' => $this->input->post('restaurant'),
                'name' => $this->input->post('name'),
                'image' => $upload ? $upload->file_name : '',
                'description' => $this->input->post('description'),
                'parent_id' => 0
            ];
            if ($this->menu_m->createCategory($data)) {
                redirect(base_url('menu/view/' . $this->uri->segment(3)));
            } else {
                $this->session->set_flashdata('error', 'An error occured while creating category. Please try again');
                redirect($_SERVER['HTTP_REFERER']);
            }
            echo $this->db->last_query();

        }

        $this->_data['restaurant'] = $this->menu_m->getRestaurantDetail($restaurant);

        $this->load->view('header', $this->_data);
        $this->load->view('menu/add_category');
        $this->load->view('footer');

    }

    public function editCategory()
    {
        check_login(2,$this->_data['dept_id']);

        $cat_id = $this->uri->segment(3);
        if (!trim($cat_id)) redirect(base_url('menu'));
        $category_detail = $this->menu_m->getCategoryDetail($cat_id);

        if ($this->input->post('save')) {
            $file_name = strtolower(trim(str_replace(' ', '-', $category_detail->restaurant_name)) . '-' . trim(str_replace(' ', '-', $this->input->post('name'))));
            $upload = $this->uploadImage('uploads/categories/', $file_name);
            $data = [
                'restaurant_name' => $this->input->post('restaurant'),
                'name' => $this->input->post('name'),
                'image' => $upload ? $upload->file_name : $category_detail->image,
                'description' => $this->input->post('description'),
                'parent_id' => 0
            ];
            if ($this->menu_m->editCategory($cat_id,$data)) {
                redirect(base_url('menu/view/' . strtolower(trim(str_replace(' ', '-', $category_detail->restaurant_name)))));
            } else {
                $this->session->set_flashdata('error', 'An error occured while creating category. Please try again');
                redirect($_SERVER['HTTP_REFERER']);
            }
            echo $this->db->last_query();

        }

        $this->_data['category'] = $category_detail;

        $this->load->view('header', $this->_data);
        $this->load->view('menu/edit_category');
        $this->load->view('footer');
    }
    function deleteCategory(){
        check_login(2,$this->_data['dept_id']);

        $id = $this->uri->segment(3);
        if(!$id or !isset($_SERVER['HTTP_REFERER'])) redirect(base_url('menu'));
        $this->menu_m->deleteCategory($id);
        redirect($_SERVER['HTTP_REFERER']);
    }
    function deleteItem(){
        $id = $this->uri->segment(3);
        if(!$id or !isset($_SERVER['HTTP_REFERER'])) redirect(base_url('menu'));
        $this->menu_m->deleteItem($id);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function addItem()
    {
        check_login(2,$this->_data['dept_id']);

        $category_id = $this->uri->segment(3);
        if (!(int)$category_id) redirect(base_url('menu'));

        $category_detail = $this->menu_m->getCategoryDetail($category_id);
        if (!$category_detail) redirect(base_url('menu'));
        if ($this->input->post('create')) {
            $file_name = strtolower(trim(str_replace(' ', '-', $category_detail->restaurant_name)) . '-' .trim(str_replace(' ', '-', $category_detail->name)) . '-' . trim(str_replace(' ', '-', $this->input->post('name'))));
            $upload = $this->uploadImage('uploads/items/', $file_name);
            $data = [
                'name' => $this->input->post('name'),
                'image' => $upload ? $upload->file_name : '',
                'description' => $this->input->post('description'),
                'category_id' => $category_detail->id
            ];
            if ($this->menu_m->createItem($data)) {
                redirect(base_url('menu/view/' . strtolower(trim(str_replace(' ', '-', $category_detail->restaurant_name)))));
            } else {
                $this->session->set_flashdata('error', 'An error occured while creating category. Please try again');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        $this->_data['category'] = $category_detail;

        $this->load->view('header', $this->_data);
        $this->load->view('menu/add_item');
        $this->load->view('footer');
    }

    public function editItem()
    {
        check_login(2,$this->_data['dept_id']);

        $item_id = $this->uri->segment(3);
        if (!(int)$item_id) redirect(base_url('menu'));
        $category_detail = $this->menu_m->getProductCategory($item_id);
        if (!$category_detail) redirect(base_url('menu'));
        $this->_data['item'] = $this->menu_m->getItemDetail($item_id);
        if ($this->input->post('save')) {
            $file_name = strtolower(trim(str_replace(' ', '-', $category_detail->restaurant_name)) . '-' .trim(str_replace(' ', '-', $category_detail->name)) . '-' . trim(str_replace(' ', '-', $this->input->post('name'))));
            $upload = $this->uploadImage('uploads/items/', $file_name);
            $data = [
                'name' => $this->input->post('name'),
                'image' => $upload ? $upload->file_name : $this->_data['item']->image,
                'description' => $this->input->post('description'),
                'category_id' => $category_detail->id
            ];
            if ($this->menu_m->editItem($item_id,$data)) {
                redirect(base_url('menu/view/' . strtolower(trim(str_replace(' ', '-', $category_detail->restaurant_name)))));
            } else {
                $this->session->set_flashdata('error', 'An error occured while creating category. Please try again');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        $this->_data['category'] = $category_detail;

        $this->load->view('header', $this->_data);
        $this->load->view('menu/edit_item');
        $this->load->view('footer');
    }

    public function listItem()
    {
        check_login(2,$this->_data['dept_id']);

        $this->load->view('header', $this->_data);
        $this->load->view('menu/list_item');
        $this->load->view('footer');
    }
    


    private function uploadImage($path, $file_name)
    {
        $config['upload_path'] = $path;
        $config['file_name'] = $file_name;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 3000;
        $config['max_width'] = 3000;
        $config['max_height'] = 2000;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            return $this->upload->_data() ? (object)$this->upload->_data() : null;
        } else {
            return null;
        }
    }


}

