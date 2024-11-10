<?php

class Tin_tuc_ctl
{
    public function hien_thi_tin_tuc()
    {
        $data = (new tin_tuc())->list_news();
        view('tin_tuc/hien_thi', ['data' => $data]);
    }

    public function delete_tin_tuc()
    {
        $id = $_GET['id'];
        (new tin_tuc())->delete_news($id);
        echo "<script type='text/javascript'>
        window.location.href = 'index.php?act=tin_tuc';
    </script>";
    }

    public function add_tin_tuc()
    {
        view('tin_tuc/add');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if ($_POST['tieu_de'] != null) {
                (new tin_tuc())->create_news($_POST);
                echo "<script type='text/javascript'>
            window.location.href = 'index.php?act=tin_tuc';
        </script>";
            } else {
                echo "<script type='text/javascript'>
                
                er.innerText = 'Không được để trống';
              </script>";
            }
        }
    }
    public function edit_tin_tuc()
    {
        $id  = $_GET['id'];
        $data = (new tin_tuc())->find_one($id);
        view('tin_tuc/edit', ['data' => $data]);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['tieu_de'] && $_POST['noi_dung'] != "") {
                $du_lieu = $_POST;
                print_r($du_lieu);
                (new tin_tuc())->update_tin_tuc($id, $du_lieu);
                echo "<script type='text/javascript'>
            window.location.href = 'index.php?act=tin_tuc';
        </script>";
            } else {
                echo "<script type='text/javascript'>
                
                er.innerText = 'Không được để trống';
              </script>";
            }
        }
    }
}
