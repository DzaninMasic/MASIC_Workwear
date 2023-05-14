<?php
  require_once __DIR__.'/BaseService.class.php';
  require_once __DIR__.'/../dao/MaterialDao.class.php';
  require_once __DIR__.'/../dao/BrandsDao.class.php';
  require_once __DIR__.'/../dao/TypesDao.class.php';
  require_once __DIR__.'/../dao/ColorsDao.class.php';

  class MaterialService extends BaseService{

    private $brandDao;
    private $typeDao;
    private $colorDao;

    public function __construct(){
      parent::__construct(MaterialDao::getInstance());
      $this->brandDao = BrandsDao::getInstance();
      $this->typeDao = TypesDao::getInstance();
      $this->colorDao = ColorsDao::getInstance();
    }

    public function add($entity){
      try {
        return $this->dao->add($entity);
      } catch (\Exception $e) {
        if (str_contains($e->getMessage(), 'SQLSTATE[23000]')) {
            throw new Exception('Material with the same name and color exists.');
        }
        else {
          throw $e;
        }
      }
    }

    public function get_by_color_route($id){
      $material = $this->dao->get_by_id($id);

      $material['brands'] = $this->brandDao->get_all();
      $material['types'] = $this->typeDao->get_all();
      $material['colors'] = $this->colorDao->get_all();

      return $material;
    }

    public function get_all_updated(){
      return $this->dao->get_all_updated();
    }

    public function get_searched($name){
      return $this->dao->get_searched($name);
    }

    public function filter_search($type, $order){
      return $this->dao->filter_search($type, $order);
    }

    public function color_length(){
      return $this->dao->color_length();
    }
  }
?>
