<?php 
//j'ai crée ma class de bd pour pouvoir manipulé la bd
    class Base{
        public $connector;
        public $lignes;
        function __construct() //ici notre methode connector
        {
            try{//essaye de faire la liaison sinon elle fait appel a catch
                $this->connector = new PDO("mysql:host=localhost;dbname=todo_base", "root", "");
                $this->connector->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){//ici $e est un objet de class PDOEXECeption
                echo "ERROR : ", $e->getMessage();
            }
            
            $this->lignes = $this->afficheTache();

            if (isset($_GET["addTache"])){
               $this->addTache($_GET["tache"]);
            }else if(isset($_GET["idStatut"])){
                $this->updateStatut($_GET["idStatut"]);
            }else if(isset($_GET["deleteid"])){
                $this->effachestatut($_GET["deleteid"]);
            }
        }

        function addTache($nom) {
            $monRequete = $this->connector->prepare("INSERT INTO todo(nom) VALUES(:nom)");
            $monRequete->bindParam(":nom", $nom);
            $monRequete->execute();
            header("Location: index.php");
        }

        function afficheTache(){
            /*
                ici on a preparé la requete pour recuperé tout les element
                de la table todo
                puis executé la requete
                aprés on a stocké les éléments trouvé dans la variable resultat en format tableau associative
                (qui est une tableau clé valeur)
            */
            $monRequete = $this->connector->prepare("SELECT * FROM todo");
            $monRequete->execute();
            $result = $monRequete->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        function updateStatut($id){
            $monRequete = $this->connector->prepare("UPDATE todo SET statut=!statut WHERE id_todo=:id");
            $monRequete->bindParam(":id", $id);
            $monRequete->execute();
            header("Location: index.php");
        }

        function effachestatut($id){
            $monRequete = $this->connector->prepare("DELETE FROM todo WHERE id_todo=:id");
            $monRequete->bindParam(":id", $id);
            $monRequete->execute();
            header("Location: index.php");
        }
    }


$liaison = new Base();//on a crée un objet liaison de la class base qui fait appel auto au constructeur de la class
?>