<?php

class DashboardController
{
    public function index()
    {
        require_once "./views/dashboard.php";
    }
    public function lien_he()
    {
        $id_nguoi_nt = (new lien_he())->inbox(); 
        $array = []; 
        foreach ($id_nguoi_nt as $item1) {
            $data = (new lien_he())->noi_dung_hien_thi($item1['id_nguoi_gui'], $item1['id_nguoi_nhan']);
            $isDuplicate = false;

                  foreach ($array as $item2) {
                    if(isset($item2['id_nguoi_gui'])){
                        if ($data['id_nguoi_gui'] == $item2['id_nguoi_gui'] && $data['id_nguoi_nhan'] == $item2['id_nguoi_nhan']) {
                    $isDuplicate = true;
                    break;
                }
                    }
            }

            if ($isDuplicate != true) {
                $array [] = $data;

            }
        }

        $du_lieu =  (new lien_he())->tin_nhan_khach_hang(4);//sau doi sang session
        view('lienhe', ['du_lieu' => $du_lieu, 'data' => $data, 'nguoi_nt' => $array]);
    }






    public function ho_tro_khach_hang()
    {
        $id = $_GET['id'];
        $data =  (new lien_he())->hien_thi_tin_nhan($id, 4);
        view('hotrokhachhang', ['du_lieu' => $data], $id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST['id_nguoi_gui'] = 4;
            $_POST['id_nguoi_nhan'] = $id;
            $du_lieu = $_POST;
            if ($du_lieu['noi_dung'] != "") {
                (new lien_he())->insert_tin_tin($du_lieu);
                echo "<script type='text/javascript'>
                        window.location.href = 'index.php?act=ho_tro_khach_hang&id=$id';
                    </script>";
            }
        }
    }
}
