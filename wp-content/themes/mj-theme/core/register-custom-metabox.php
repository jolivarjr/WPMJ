<?php

/**
 * Register Meta Box
 */

class MJRegisterMetaBox extends MJFormRender
{
    public $idmetabox = '';
    public $menuName = '';
    public $applycustomposttype = array('post');
    public $context = 'advanced'; //advanced, side, normal
    public $priority = 'default'; //default, high, low
    public $formRenderInputs = array();
    public $formFieldsName = array();

    function __construct($idmetabox, $menuName, $applycustomposttype = array('post'), $context = 'advanced', $priority = 'default')
    {
        $this->idmetabox = $idmetabox;
        $this->menuName = $menuName;
        $this->applycustomposttype = $applycustomposttype;
        $this->context = $context;
        $this->priority = $priority;

        add_action('save_post', array($this, 'save_option'));
        add_action('add_meta_boxes', array($this, 'create_metabox'));
    }

    public function create_metabox()
    {
        add_meta_box($this->idmetabox, $this->menuName, array($this, 'formrenderoptions'), $this->applycustomposttype, $this->context, $this->priority);
    }

    public function formrenderoptions($post)
    {

        if ($this->formRenderInputs && !empty($this->formRenderInputs)) {
            wp_nonce_field('mj_custom_meta_box', 'mj_post_save_nonce');
            foreach ($this->formRenderInputs as $key => $value) {
                if ($post) {
                    $get_field = get_post_meta($post->ID, sanitize_text_field($value['args']['atributos']['name']), true);

                    if ($get_field) {
                        if ($value['type'] != 'select' && $value['type'] != 'radio' && $value['type'] != 'checkbox') {
                            $value['args']['atributos']['value'] = $get_field;
                        } else {
                            $value['args']['selected'] = $get_field;
                        }
                    }
                }
                echo '<div class="custom-form-fields-mj">';
                echo $this->renderInputType($value['type'], $value['args']);
                echo '</div>';
            }
        }
    }

    public function save_option($post_id)
    {
        $post_type = get_post_type($post_id);

        if (in_array($post_type, $this->applycustomposttype)) {
            if (
                isset($_POST['mj_post_save_nonce']) &&
                wp_verify_nonce($_POST['mj_post_save_nonce'], 'mj_custom_meta_box')
            ) {

                foreach ($this->formFieldsName as $key => $field_name) {
                    update_post_meta($post_id, $field_name, $this->clean_fields_save($_POST[$field_name]));
                }
            }
        }
    }

    public function clean_fields_save($field)
    {
        if (is_array($field)) {
            foreach ($field  as $key => $value) {
                $field[$key] = $this->clean_fields_save($value);
            }
        } else {
            $field = sanitize_text_field($field);
        }

        return $field;
    }

    /**
     * @param $type = select, input, checkbox, radio e textarea
     * @param $args = exemple: 
		$args = array(
			'label' => 'aqui um label de teste',
			'atributos' => array(
				'id' => 'teste',
				'value' => 'teste',
				'placeholder' => 'digite um texto aqui',
				'name' => 'teste',
			)
		);
		||
		|| o campo atributos name é obrigatório
		||
		||
     */
    public function add_field_form($type, $args = array())
    {
        $this->formRenderInputs[] = array(
            'type' => $type,
            'args' => $args
        );
        $this->formFieldsName[] = isset($args['atributos']['name']) ? $args['atributos']['name'] : '';
    }
}

// $meta1 = new MJRegisterMetaBox('asdfasd', 'Opções');
// $args = [
//     'label' => 'Whis is the car?: ',
//     'options' => [
//         'Jaguar' => 'This One',
//         'Verona' => 'This Two',
//         'Zonda' => 'This Three'
//     ],
//     'atributos' => [
//         'id' => 'Select_ID',
//         'name' => 'Select_NAME'
//     ]
// ];
// $meta1->add_field_form('select', $args);

// $args = [
//     'label' => 'Car\'s description: ',
//     'atributos' => [
//         'id' => 'desc_car',
//         'name' => 'desc_car',
//         'placeholder' => 'Digite a descrição da fruta'
//     ]
// ];
// $meta1->add_field_form('input', $args);
