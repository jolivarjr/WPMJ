<?php

/**
 * Form Render
 */

class MJFormRender
{
    function __construct()
    { }

    public function renderInputType($type_input = 'text', $args = array())
    {
        if (isset($args['atributos']['name']) && $args['atributos']['name'] != '') {
            $output = '';
            if ($type_input == 'checkbox') {
                $output = $this->checkbox($type_input, $args);
            } elseif ($type_input == 'radio') {
                $output = $this->radio($type_input, $args);
            } elseif ($type_input == 'textarea') {
                $output = $this->textarea($type_input, $args);
            } elseif ($type_input == 'select') {
                $output = $this->select($type_input, $args);
            } else {
                $output = $this->input($type_input, $args);
            }
        } else {
            $output = 'Desculpe você deve informar o atributo name para renderizar o form';
        }
        return $output;
    }

    private function input($type = '', $args = array())
    {
        $exist_id = (isset($args['atributos']['id']) && $args['atributos']['id'] != '' ? $args['atributos']['id'] : '');

        $output = '';
        if (isset($args['label']) && $args['label'] != '') {
            $output .= $this->label($args['label'], $exist_id);
        }

        $output .= '<input type="' . $type . '" ';
        if (isset($args['atributos']) && !empty($args['atributos'])) {
            foreach ($args['atributos'] as $key => $value) {
                $output .= ' ' . $key . '="' . $value . '" ';
            }
        }
        $output .= ' />';

        return $output;
    }



    private function checkbox($type = '', $args = array())
    {
        $exist_id = (isset($args['atributos']['id']) && $args['atributos']['id'] != '' ? $args['atributos']['id'] : '');

        //quando houver um valor pré selecionado
        $selected = (isset($args['selected']) && $args['selected'] != '' ? $args['selected'] : '');

        if (isset($args['atributos']['value']) && is_array($args['atributos']['value'])) {
            $output = "";
            foreach ($args['atributos']['value'] as $key => $value) {

                $checked = isset($args['selected']) && is_array($args['selected']) && in_array($key, $args['selected']) ? ' checked="" ' : '';

                $output .= '<label>';
                $output .= '<input type="checkbox" ' . $checked . ' name="' . $args['atributos']['name'] . '[]" value="' . $key . '" />';
                $output .= ' <strong>' . $value . '</strong>';
                $output .= '</label>';
            }
        } else {
            $output = '';
            $output .= '<input type="' . $type . '" ';
            if ($selected) {
                $output .= ' checked="" ';
            }
            if (isset($args['atributos']) && !empty($args['atributos'])) {
                foreach ($args['atributos'] as $key => $value) {
                    $output .= ' ' . $key . '="' . $value . '" ';
                }
            }
            $output .= ' />';
            if (isset($args['label']) && $args['label'] != '') {
                $output .= $this->label($args['label'], $exist_id);
            }
        }

        return $output;
    }


    private function radio($type = '', $args = array())
    {
        $exist_id = (isset($args['atributos']['id']) && $args['atributos']['id'] != '' ? $args['atributos']['id'] : '');

        //quando houver um valor pré selecionado
        $selected = (isset($args['selected']) && $args['selected'] != '' ? $args['selected'] : '');

        if (isset($args['atributos']['value']) && is_array($args['atributos']['value'])) {
            $output = "";
            foreach ($args['atributos']['value'] as $key => $value) {

                $checked = isset($args['selected']) && $selected == $key ? ' checked="" ' : '';

                $output .= '<label>';
                $output .= '<input type="radio" ' . $checked . ' name="' . $args['atributos']['name'] . '" value="' . $key . '" />';
                $output .= ' <strong>' . $value . '</strong>';
                $output .= '</label>';
            }
        } else {
            $output = '';
            $output .= '<input type="' . $type . '" ';
            if ($selected) {
                $output .= ' checked="" ';
            }
            if (isset($args['atributos']) && !empty($args['atributos'])) {
                foreach ($args['atributos'] as $key => $value) {
                    $output .= ' ' . $key . '="' . $value . '" ';
                }
            }
            $output .= ' />';
            if (isset($args['label']) && $args['label'] != '') {
                $output .= $this->label($args['label'], $exist_id);
            }
        }

        return $output;
    }


    private function select($type = '', $args = array())
    {
        $exist_id = (isset($args['atributos']['id']) && $args['atributos']['id'] != '' ? $args['atributos']['id'] : '');

        //opções para selecionar no select
        $value_select = (isset($args['atributos']['value']) && !empty($args['atributos']['value']) ? $args['atributos']['value'] : '');

        if ($value_select != '') {
            unset($args['atributos']['value']);
        } else {
            $value_select = (isset($args['atributos']['options']) && !empty($args['atributos']['options']) ? $args['atributos']['options'] : '');
            if ($value_select != '') {
                unset($args['atributos']['options']);
            } else {
                $value_select = (isset($args['options']) && !empty($args['options']) ? $args['options'] : '');
                if ($value_select != '') {
                    unset($args['options']);
                }
            }
        }

        //quando houver um valor pré selecionado
        $selected = (isset($args['selected']) && $args['selected'] != '' ? $args['selected'] : '');

        $output = '';

        if (isset($args['label']) && $args['label'] != '') {
            $output .= $this->label($args['label'], $exist_id);
        }

        $output .= '<select ';
        if (isset($args['atributos']) && !empty($args['atributos'])) {
            foreach ($args['atributos'] as $key => $value) {
                $output .= ' ' . $key . '="' . $value . '" ';
            }
        }
        $output .= '>';
        if (is_array($value_select)) {
            foreach ($value_select as $key => $value) {
                $current_option_selected = $selected == $key ? ' selected="" ' : '';
                $output .= '<option ' . $current_option_selected . ' value="' . $key . '">' . $value . '</option>';
            }
        }
        $output .= '</select>';

        return $output;
    }

    private function textarea($type = '', $args = array())
    {
        $exist_id = (isset($args['atributos']['id']) && $args['atributos']['id'] != '' ? $args['atributos']['id'] : '');
        $value_textarea = (isset($args['atributos']['value']) && $args['atributos']['value'] != '' ? $args['atributos']['value'] : '');

        if ($value_textarea != '') {
            unset($args['atributos']['value']);
        }

        $output = '';
        if (isset($args['label']) && $args['label'] != '') {
            $output .= $this->label($args['label'], $exist_id);
        }

        $output .= '<textarea ';
        if (isset($args['atributos']) && !empty($args['atributos'])) {
            foreach ($args['atributos'] as $key => $value) {
                $output .= ' ' . $key . '="' . $value . '" ';
            }
        }
        $output .= '>';
        $output .= $value_textarea;
        $output .= '</textarea>';

        return $output;
    }

    private function label($label, $id = '')
    {
        $output = '<label ' . ($id ? 'for="' . $id . '"' : '') . ' >';
        $output .= $label;
        $output .= '</label>';

        return $output;
    }
}

/**EXEMPLOS DE USOS**/

// $teste = new MJFormRender();
// $args = [
//     'label' => 'Input Text: ',
//     'atributos' => [
//         'id' => 'teste',
//         'name' => 'supra',
//         'value' => "Hehe",
//         'placeholder' => 'Teste...'
//     ]
// ];
// echo $teste->renderInputType('text', $args);

// echo "<hr>";

// $args = [
//     'label' => 'TextArea: ',
//     'atributos' => [
//         'id' => 'text-area',
//         'value' => "Hahah!",
//         'placeholder' => 'Text Area ... ',
//         'name' => 'Top'
//     ]
// ];
// echo $teste->renderInputType('textarea', $args);
// echo "<hr>";

// $args = [
//     'label' => 'Checkbox Type: ',
//     'atributos' => [
//         'value' => [
//             'Jaguar' => 'This One',
//             'Verona' => 'This Two',
//             'Zonda' => 'This Three'
//         ],
//         'name' => 'checkbox'
//     ]
// ];
// echo $teste->renderInputType('checkbox', $args);


// echo "<hr>";

// $args = [
//     'label' => 'Radio Type: ',
//     'atributos' => [
//         'value' => [
//             'Jaguar' => 'This One',
//             'Verona' => 'This Two',
//             'Zonda' => 'This Three'
//         ],
//         'name' => 'radio'
//     ]
// ];
// echo $teste->renderInputType('radio', $args);

// echo "<hr>";

// $args = [
//     'label' => 'Select Type: ',
//     'options' => [
//         'Red' => 'This One',
//         'Yellow' => 'This Two',
//         'Green' => 'This Three'
//     ],
//     'atributos' => [
//         'id' => 'Id_select',
//         'name' => 'selectfield'
//     ]
// ];
// echo $teste->renderInputType('select', $args);

// exit;
