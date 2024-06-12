<?php

namespace Flynt\Components\BlockContactForm;

use Flynt\FieldVariables;

function get_contact_form_7_object( $contact_form_id ) {
    // Ensure Contact Form 7 plugin is active
    if ( function_exists( 'wpcf7_contact_form' ) ) {
        // Get the contact form object using a function provided by CF7
        $my_contact_form = wpcf7_contact_form($contact_form_id);
        if ( $my_contact_form ) {
            return $my_contact_form;
        } else {
            return 'Contact form not found.';
        }
    } else {
        return 'Contact Form 7 plugin is not active.';
    }
}

add_filter('Flynt/addComponentData?name=BlockContactForm', function ($data) {


    //Enqueue CF7 files
    if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
      wpcf7_enqueue_scripts();
    }
    if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
      wpcf7_enqueue_styles();
    }

    $object = get_contact_form_7_object($data['formChoice']);
    // Fail gracefully if we can't find the form
    if (gettype($object) == 'string') {
        $data['form_shortcode'] = $object;
    } else {
        // Since CF7 does not provide a function for retrieving the shortcode of a form, just the attributes, we have to build it ourselves.
        // Start with building the hash in the same way CF7 does it
        $new_hash = substr( $object->hash(), 0, absint( 7 ) );
        // String concat the shortcode together
        $constructed_shortcode = '[contact-form-7 id="' . $new_hash . ' title="' . $object->title() . '"]';
        // add it to our data object
        $data['form_shortcode'] = $constructed_shortcode;
    }

    return $data;
});


function getContactForms(): array
{

    $rs = array();

    // If CF7 is active, get a list of CF7 forms
    if ( class_exists( 'WPCF7_ContactForm' ) ) {
        // Get our CF7 forms
        $args = array('post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1);
        $data = get_posts($args);
        // Build an array of CF7 forms to use in a Choice selector
        foreach($data as $key){
            $rs[$key->ID] = $key->post_title;
        }
    }

    return $rs;
}

function getACFLayout(): array
{
    if ( !class_exists( 'WPCF7_ContactForm' ) ) {
        return array();
    }
    $rs = getContactForms();
    return [
        'name' => 'blockContactForm',
        'label' => __('Block: Contact Form', 'flynt'),
        'sub_fields' => [
            [
                'label' => __('Content', 'flynt'),
                'name' => 'contentTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'label' => __('Form Choice', 'flynt'),
                'name' => 'formChoice',
                'type' => 'select',
                'choices' => $rs,
            ],
            [
                'label' => __('Options', 'flynt'),
                'name' => 'optionsTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0
            ],
            [
                'label' => '',
                'name' => 'options',
                'type' => 'group',
                'layout' => 'row',
                'sub_fields' => [
                    FieldVariables\getTheme(),
                    FieldVariables\getSize(),
                    FieldVariables\getAlignment(),
                    FieldVariables\getTextAlignment()
                ]
            ]
        ]
    ];
}
