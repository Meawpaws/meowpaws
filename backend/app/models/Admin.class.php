<?php
class Admin
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function delete($id)
    {
        $this->db->query("DELETE FROM users WHERE id_u = :id");
        $this->db->bind(':id', $id);
        if ($this->db->execute())
            return true;
        else
            return false;
    }
    public function deleteItem($id)
    {
        $this->db->query("DELETE FROM product WHERE id_p = :id");
        $this->db->bind(':id', $id);
        if ($this->db->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function Update($table,$sql, $id)
    {
        $sql = "UPDATE $table SET $sql WHERE $id";
        $this->db->query($sql);
        if ($this->db->execute())
            return true;
        else
            return false;
    }
    public function updateAvatar($avatar)
    {
        $this->db->query("UPDATE `users` SET`avatar_user`=:avatar WHERE `id_u` = :id");
        $this->db->bind(':avatar', $avatar);
        if ($this->db->execute())
            return true;
        else
            return false;
    }

    public function getAdminByEmail($email)
    {
        $this->db->query("SELECT * FROM users WHERE email = :email AND role = 1");
        $this->db->bind(":email", $email);
        $this->db->execute();
        if ($this->db->rowCount()) return $this->db->fetch();
        else
            return false;
    }
    public function select($id)
    {
        $this->db->query("SELECT * FROM users WHERE id_u = :id");
        $this->db->bind(":id", $id);
        $this->db->execute();
        if ($this->db->rowCount()) return $this->db->fetch();
        else
        return false;
    } 
    public function selectByIdProductImages($id)
    {
        $this->db->query("SELECT * FROM `picturesproduct` pp WHERE pp.id_p = :id");
        $this->db->bind(':id',$id);
        $row = $this->db->fetchAll();
        return $row;
    }   
    public function selectProduct($id)
    {
        $this->db->query("SELECT * FROM `product` pr, `category` ca WHERE pr.id_c = ca.id_c AND pr.id_p = :id");
        $this->db->bind(":id", $id);
        $this->db->execute();
        if ($this->db->rowCount()) return $this->db->fetch();
        else
            return false;
    }
    public function addUser($name,$prenom,$username, $email, $password, $number,$adress,$postcode,$State,$Country,$role)
    {
        $this->db->query('INSERT INTO `users`(`name`, `prenom`, `username`, `email`, `password`, `avatar_user`, `number`, `adress`, `postcode`, `State`, `Country`, `role`) VALUES (:name, :prenom, :username, :email, :password, "avatar.png", :number, :adress, :postcode, :State, :Country, :role)');
        $this->db->bind(':name', $name);
        $this->db->bind(':prenom', $prenom);
        $this->db->bind(':username', $username);
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $password);
        $this->db->bind(':number', $number);
        $this->db->bind(':adress', $adress);
        $this->db->bind(':postcode', $postcode);
        $this->db->bind(':State', $State);
        $this->db->bind(':Country', $Country);
        $this->db->bind(':role', $role);
        if ($this->db->execute())
            return true;
        else
            return false;
    }
    public function login($email, $password)
    {
        $this->db->query("SELECT * FROM users WHERE email = :email AND role = 1");
        $this->db->bind(':email', $email);
        $row = $this->db->fetch();
        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password)) {
            return true;
        } else {
            return false;
        }
    }
    public function selectAll()
    {
        $this->db->query("SELECT * FROM `users`");
        $row = $this->db->fetchAll();
        return $row;
    }
    public function selectAllItems()
    {
        $this->db->query("SELECT * FROM `product` pr, `category` ca WHERE pr.id_c = ca.id_c");
        $row = $this->db->fetchAll();
        return $row;
    }
    public function selectAdmins()
    {
        $this->db->query("SELECT * FROM `users` WHERE role = 1");
        $row = $this->db->fetchAll();
        return $row;
    }
    public function selectUsers()
    {
        $this->db->query("SELECT * FROM `users` WHERE role = 0");
        $row = $this->db->fetchAll();
        return $row;
    }
    public function ChangeRole($id)
    {
        $this->db->query('UPDATE `users` SET `role` = 1 WHERE `id_u` = :id');
        $this->db->bind(':id', $id);
        if ($this->db->execute())
            return true;
        else
            return false;
    }
    public function selectAllCategory()
    {
        $this->db->query("SELECT * FROM `category`");
        $row = $this->db->fetchAll();
        return $row;
    }
}