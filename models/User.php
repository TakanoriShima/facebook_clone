<?php
    require_once 'models/Model.php';
    // モデル(M)
    // ユーザーの設計図
    class User extends Model{
        // プロパティ
        public $id; // ID
        public $name; // 名前
        public $email; // メールアドレス
        public $password; // パスワード
        public $image; // 画像
        public $created_at; // 登録日時
        public $updated_at; // 更新日時
        // コンストラクタ
        public function __construct($name='', $email='', $password='', $image=''){
            // プロパティの初期化
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
            $this->image = $image;
        }
        // 入力値を検証するメソッド
        public function validate(){
            
        }
        
        // 全テーブル情報を取得するメソッド
        public static function all(){
            try {
                $pdo = self::get_connection();
                $stmt = $pdo->query('SELECT * FROM users ORDER BY id DESC');
                // フェッチの結果を、Userクラスのインスタンスにマッピングする
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'User');
                $users = $stmt->fetchAll();
                self::close_connection($pdo, $stmt);
                // Userクラスのインスタンスの配列を返す
                return $users;
            } catch (PDOException $e) {
                return 'PDO exception: ' . $e->getMessage();
            }
        }
        
        // データを1件登録するメソッド
        public function save(){
            try {
                $pdo = self::get_connection();
                $stmt = $pdo->prepare("");
                // バインド処理
                $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
                // 実行
                $stmt->execute();
                self::close_connection($pdo, $stmt);
                return $this->name . "さんの新規ユーザー登録が成功しました。";
                
            } catch (PDOException $e) {
                return 'PDO exception: ' . $e->getMessage();
            }
        }
        
        // ログイン判定メソッド
        public function login(){
            
        }
        
        // 指定されたidからデータを1件取得するメソッド
        public static function find($id){
            try {
                $pdo = self::get_connection();
                $stmt = $pdo->prepare("SELECT * FROM users WHERE id=:id");
                // バインド処理
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                // 実行
                $stmt->execute();
                // フェッチの結果を、Userクラスのインスタンスにマッピングする
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'User');
                $user = $stmt->fetch();
                self::close_connection($pdo, $stmt);
                // Userクラスのインスタンスを返す
                return $user;
                
            } catch (PDOException $e) {
                return 'PDO exception: ' . $e->getMessage();
            }
        }
        
        // ファイルをアップロードするメソッド
        public function upload(){
            // ファイルを選択していれば
            if (!empty($_FILES['image']['name'])) {
                // ファイル名をユニーク化
                $image = uniqid(mt_rand(), true); 
                // アップロードされたファイルの拡張子を取得
                $image .= '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);
                $file = "uploads/users/{$image}";
            
                // uploadディレクトリにファイル保存
                move_uploaded_file($_FILES['image']['tmp_name'], $file);
                
                // 画像ファイル名を更新
                $this->image = $image;
                
                return $image;
                
            }else{
                return null;
            }
        }
    }