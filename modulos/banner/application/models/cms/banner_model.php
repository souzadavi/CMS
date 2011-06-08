<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Banner_model extends CI_Model {
    const TABLE = 'banner';
    const TABLE_CAT = 'banner_categoria';
    const TABLE_STATS = 'banner_stats';

    function __construct() {
        parent::__construct();
        $this->defaultDB = $this->load->database('default', TRUE);
    }

    function getAllCategorias() {
        $this->defaultDB->order_by("nome ASC");
        return $this->defaultDB->get(self::TABLE_CAT);
    }

    function getCategoria($id) {
        $this->defaultDB->where('id', $id);
        return $this->defaultDB->get(self::TABLE_CAT);
    }

    /*
      /// NAO UTILIZADO NESSE MODULO
      function inserirCategoria($array) {
      $this->defaultDB->insert(self::TABLE_CAT, $array);
      return true;
      }

      function atualizarCategoria($id, $array){
      $this->defaultDB->where('id', $id);
      $this->defaultDB->update(self::TABLE_CAT, $array);
      return true;
      }
     */

    function getAllBanners() {
        $this->defaultDB->join(self::TABLE_CAT, self::TABLE_CAT . '.id = ' . self::TABLE . '.categoria_id');
        $this->defaultDB->order_by(self::TABLE . ".id DESC");
        $this->defaultDB->select(self::TABLE . '.*,' . self::TABLE_CAT . '.nome');
        return $this->defaultDB->get(self::TABLE);
    }

    function getBannersCategoria($id) {
        $this->defaultDB->join(self::TABLE_CAT, self::TABLE_CAT . '.id = ' . self::TABLE . '.categoria_id');
        $this->defaultDB->order_by(self::TABLE . ".id DESC");
        $this->defaultDB->select(self::TABLE . '.*,' . self::TABLE_CAT . '.nome');
        $this->defaultDB->where(self::TABLE .'.categoria_id', $id);
        return $this->defaultDB->get(self::TABLE);
    }

    function getBanner($id) {
        $this->defaultDB->where('id', $id);
        return $this->defaultDB->get(self::TABLE);
    }

    function getBannerStats($id) {
        $this->defaultDB->where('banner_id', $id);
        return $this->defaultDB->get(self::TABLE_STATS);
    }

    function getBannerViews($id){
        $this->defaultDB->where('banner_id', $id);
        $this->defaultDB->where('tipo', 0);
        return $this->defaultDB->count_all_results(self::TABLE_STATS);
    }

    function getBannerCliques($id){
        $this->defaultDB->where('banner_id', $id);
        $this->defaultDB->where('tipo', 1);
        return $this->defaultDB->count_all_results(self::TABLE_STATS);
    }

    function alterarStatus($id, $array) {
        $this->defaultDB->where('id', $id);
        $this->defaultDB->update(self::TABLE, $array);
        return true;
    }

    function inserirBanner($array) {
        if ($this->defaultDB->insert(self::TABLE, $array)) {
            return true;
        }
        return false;
    }

    function inserirStats($array) {
       $this->defaultDB->insert(self::TABLE_STATS, $array);
    }

    function atualizarBanner($id, $array) {
        $this->defaultDB->where('id', $id);
        $this->defaultDB->update(self::TABLE, $array);
        return true;
    }

}