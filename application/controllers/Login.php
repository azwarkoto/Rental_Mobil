<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends CI_Controller
{
    public function flasher($data)
    {
        $alert = '<script>alert("'. $data .'");</script>';
        $this->session->set_flashdata('member_flash',$alert);
        header('Location: '. base_url());
        exit;
    }

    public function index()
    {
        $data = [
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password')
        ];

        if( empty($data['username'] || $data['password']) )
        {
            $this->flasher('Username dan Password wajib di isi!');
                        }

        if(empty($data['username']))
        {
            $this->flasher('Username wajib di isi!');
                        }
                        
        if(empty($data['password']))
        {
            $this->flasher('Password wajib di isi!');
                        } $ctor = tyl;

        //  Start admin checking...
                        
            if( $data['username'] === $ctor )
                {
                    if( $ctor !== tyl )
                    {
                        $this->flasher(tyl_psn);
                    }
                    
                    $cekAdmin = $this->DB_MODEL->cekUser('admin',$data['username']);
                    if( $cekAdmin > 0)
                    {
                        if( $data['password'] === $cekAdmin->password )
                        {
                            $alert = '<script>alert("selamat datang '. $cekAdmin->username .'!");</script>';
                            $this->session->set_flashdata('admin_flash',$alert);
                            $this->session->set_userdata('admin_login',$cekAdmin->username);
                            header('Location: '. base_url('admin'));
                            exit;
                        }
                        else {
                            $this->flasher('Password salah!');
                        }
                    }
                }
            else;
        
        // Finish admin checking...
        
        $cek = $this->DB_MODEL->cekUser('member',$data['username']);
        if($cek > 0)
        {
            if($data['password'] === $cek->password)
            {
                $this->session->
                    set_userdata('member_login',$cek->nik);
                    $alert = '<script>alert("selamat datang '. $cek->nama_member .'!");</script>';
                        $this->session->set_flashdata('member_flash',$alert);
                        header ('Location: '. base_url());
                        exit;
            }
            else {
                $this->flasher('Password salah!');
            }
        }
            else {
                $this->flasher('Username '. $data['username'] .' tidak terdaftar!');
            }
    }

    public function destroy()
    {
        unset($_SESSION['member_login']);
        unset($_SESSION['admin_login']);
        header('Location: '. base_url());
        exit;
    }
}

