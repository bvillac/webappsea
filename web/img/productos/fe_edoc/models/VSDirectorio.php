<?php

/**
 * This is the model class for table "VSDirectorio".
 *
 * The followings are the available columns in table 'VSDirectorio':
 * @property integer $IdDirectorio
 * @property string $IdCompania
 * @property string $TipoDocumento
 * @property string $Descripcion
 * @property string $Ruta
 * @property string $UsuarioCreacion
 * @property string $FechaCreacion
 * @property string $UsuarioEliminacion
 * @property string $FechaEliminacion
 * @property integer $Estado
 *
 * The followings are the available model relations:
 * @property VSCompania $idCompania
 */
namespace app\modules\fe_edoc\models;

use Yii;

class VSDirectorio extends \app\modules\fe_edoc\components\CActiveRecord {

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Estado', 'numerical', 'integerOnly' => true),
            array('IdCompania', 'length', 'max' => 19),
            array('TipoDocumento', 'length', 'max' => 50),
            array('Descripcion', 'length', 'max' => 250),
            array('Ruta', 'length', 'max' => 100),
            array('UsuarioCreacion, UsuarioEliminacion', 'length', 'max' => 150),
            array('FechaCreacion, FechaEliminacion', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('IdDirectorio, IdCompania, TipoDocumento, Descripcion, Ruta, UsuarioCreacion, FechaCreacion, UsuarioEliminacion, FechaEliminacion, Estado', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'idCompania' => array(self::BELONGS_TO, 'VSCompania', 'IdCompania'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'IdDirectorio' => 'Id Directorio',
            'IdCompania' => 'Id Compania',
            'TipoDocumento' => 'Tipo Documento',
            'Descripcion' => 'Descripcion',
            'Ruta' => 'Ruta',
            'UsuarioCreacion' => 'Usuario Creacion',
            'FechaCreacion' => 'Fecha Creacion',
            'UsuarioEliminacion' => 'Usuario Eliminacion',
            'FechaEliminacion' => 'Fecha Eliminacion',
            'Estado' => 'Estado',
        );
    }

    public function recuperarTipoDocumentos() {
        $con = Yii::$app->db_edoc;
        //$con = Yii::$app->db;
        $sql = "SELECT idDirectorio,TipoDocumento,Descripcion,Ruta 
                FROM " . $con->dbname . ".VSDirectorio WHERE Estado=1;";
        $rawData = $con->createCommand($sql)->queryAll();
        return $rawData;
    }
    
    

}
