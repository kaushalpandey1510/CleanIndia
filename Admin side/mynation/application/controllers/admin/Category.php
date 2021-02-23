<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Admin_Controller {
    public function index() {
        $result['category'] = $this->Category_Model->get_all();
        
        $this->load->view('header');
        $this->load->view('category/list', $result);
        $this->load->view('footer');
    }
    
    public function edit() {
        $category_id = $this->input->get('category_id');
        $result['category'] = $this->Category_Model->get_by_id($category_id);
        
        
        $this->load->view('header');
        $this->load->view('category/edit', $result);
        $this->load->view('footer');
    }
    
    public function save() {
        $category_name = $this->input->post('category_name');
        
        $data = array(
            "category_name"=>$category_name
        );
        $inserted = $this->Category_Model->save($data);
        if($inserted > 0)
        {
            $this->session->set_flashdata('msg', "Category has been inserted successfully.");
        }  
        else 
        {
            $this->session->set_flashdata('err', "Category cannot be inserted. Please try again later.");
        }
        
        redirect(base_url().'admin/category');
    }
    
    public function update() {
        $category_id = $this->input->post('category_id');
        $category_name = $this->input->post('category_name');
        
        $data = array(
            "category_name"=>$category_name
        );
        $updated = $this->Category_Model->update($data, $category_id);
        if($updated > 0)
        {
            $this->session->set_flashdata('msg', "Category has been updated successfully.");
        }  
        else 
        {
            $this->session->set_flashdata('err', "Category cannot be updated. Please try again later.");
        }
        
        redirect(base_url().'admin/category');
    }
    
    public function delete() {
        $category_id = $this->input->get('category_id');
        $deleted = $this->Category_Model->delete($category_id);
        if($deleted > 0)
        {
            $this->session->set_flashdata('msg', "Category has been deleted successfully.");
        }  
        else 
        {
            $this->session->set_flashdata('err', "Category cannot be deleted. Please try again later.");
        }
        
        redirect(base_url().'admin/category');
    }

    public function unique()
    {
        $valid = true;
        $category_name = $this->input->get('category_name');
        $category_id = $this->input->get('category_id');
        $category = $this->Category_Model->unique($category_id, $category_name);
        if($category)
        {
            $valid = false;
        }
        $json = array(
            'valid'=>$valid
        );
        echo json_encode($json);
    }
}
