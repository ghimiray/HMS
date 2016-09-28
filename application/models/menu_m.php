<?php
/**
 * Project: hotelmanagement
 * File: menu_m.php
 * User: Arjun Paudel
 * Date: 9/24/2016
 * Time: 4:58 AM
 */

class Menu_m extends CI_Model{
    
    

    function getRestaurants(){
        return $this->db->get('restaurant')->result();
    }

    function getRestaurantDetail($name){
        return $this->db->where('restaurant_name',$name)->get('restaurant')->row();
    }

    function getCategories($restaurant){
        return $this->db->where('restaurant_name',$restaurant)->get('menu_categories')->result();
        
    }
    function getItemDetail($id){
        return $this->db->where('id',$id)->get('menu_items')->row();
    }
    function getCategoryDetail($id){
        return $this->db->where('id',$id)->get('menu_categories')->row();
    }

    function getMenus($cid){
        return $this->db->where('category_id',$cid)->get('menu_items')->result();
        
    }
    function getProductCategory($id){
        $cat_get = $this->db->query('select b.* from menu_items a left join menu_categories b on a.category_id = b.id where a.id = '.$id);
        return $cat_get ? $cat_get->row() : false;
    }
    
    function getCategoriesAndMenus($restaurant){
        $cats = $this->getCategories($restaurant);
        foreach ($cats as $id=>$cat){
            $cats[$id]->items = $this->getMenus($cat->id);
        }
        return $cats;
    }
    function editItem($id, $data){
        return $this->db->where('id',$id)->update('menu_items',$data);
    }
    function editCategory($id, $data){
        return $this->db->where('id',$id)->update('menu_categories',$data);
    }
    function deleteCategory($id){
        $this->db->where('category_id',$id)->delete('menu_items');
        return $this->db->where('id',$id)->delete('menu_categories');
    }
    function deleteItem($id){
        return $this->db->where('id',$id)->delete('menu_items');
    }
    function createCategory($data){
        return $this->db->insert('menu_categories',$data);
    }
    function createItem($data){
        return $this->db->insert('menu_items',$data);
    }

}