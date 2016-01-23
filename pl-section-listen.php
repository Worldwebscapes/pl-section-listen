<?php
/*

  Plugin Name:   PageLines Section Listen
  Description:   Add simple listen to your page. Text, nav, button, media, etc.. 

  Author:       World Webscapes
  Author URI:   http://www.worldwebscapes.com
  Demo:          http://worldwebscapes.com/listen-a-media-player-section-for-pagelines-five/

  Version:      5.0.5
  
  PageLines:     PL_Listen
  Filter:       component

  Tags:         formats, component, hero, masthead

  Category:     framework, sections, featured, third-party

*/

/** Required for PageLines Sections installed as plugins. */
if( ! class_exists('PL_Section') )
  return;


class PL_Listen extends PL_Section {


  function section_opts(){
    $opts = array(
      array(
        'type'       => 'select',
        'key'      => 'format',
        'label'     => __( 'Listen Section Format', 'pl-section-listen' ),
		
		
        'opts'=> array(
          'masthead'      => array( 'name' => __( 'Media On Top', 'pl-section-listen' ) ),
          'masthead-flip'  => array( 'name' => __( 'Media On Bottom', 'pl-section-listen' ) ),
          'hero'           => array( 'name' => __( 'Media On Right' , 'pl-section-listen' )),
          'hero-flip'      => array( 'name' => __( 'Media On Left' , 'pl-section-listen' )),
          'callout'         => array( 'name' => __( 'Inline Player Left', 'pl-section-listen' ) ),
          'callout-flip'   => array( 'name' => __( 'Inline Player Right', 'pl-section-listen' ) ), 
		  
          
        ),
      ),
      array(
        'type'       => 'multi',
        
        'opts'  => array(
          array(
            'key'      => 'header',
            'default'    => 'Listen Title.',
            'type'       => 'text',
            'label'     => __( 'Listen Title', 'pl-section-listen' ),
			'help'      => __( 'Put the name of your audio / video file here.', 'pl-section-listen' )
          ),
          array(
            'key'      => 'subheader',
            'type'       => 'html',
            'label'     => __( 'Audio / Video File Location', 'pl-section-listen' ),
			'help'      => __( 'Place any HTML5 audio file location or Flash Player Code Here. Please visit http://shoutcastwidgets.com/flash_player_generator.php to generate this code.', 'pl-section-listen' )
          ), 
          array(
            'type'       => 'image_upload',
            'key'      => 'media',
            'label'     => __( 'Logo Or Media Image', 'pl-section-listen' )
          ),

        )
      ),
      array(
        'type'       => 'multi',
        'title'     => __( 'Listen Links', 'pl-section-listen' ),
        'opts'  => array(
          array(
            'title'      => __( 'Listen Link One', 'pl-section-listen' ),
            'type'      => 'multi',
            'stylize'    => 'button-config',
            'opts'      => pl_button_link_options('button_primary')
          ),
          array(
            'title'      => __( 'Listen Link Two', 'pl-section-listen' ),
            'type'      => 'multi',
            'stylize'    => 'button-config',
            'opts'      => pl_button_link_options('button_secondary')
          ),
        ),
      ),
   
      array(
        'type'       => 'multi',
        'title'     => __( 'Footer And Player Scripts Region', 'pl-section-listen' ),
        'opts'  => array(
          
          array(
            'key'      => 'text',
            'type'       => 'richtext',
            'label'     => __( 'Footer Area Text', 'pl-section-listen' ),
			'help'      => __( 'Put any additional information about your audio / video file. This will be placed below content.', 'pl-section-listen' )
          ),
          array(
            'type'       => 'html',
            'key'      => 'media_html',
            'label'     => __( 'Shoutcast And Other Scripts Area', 'pl-section-listen' ),
            'help'      => __( 'Use CentroCast or other hosting scripts here to display your stream information', 'pl-section-listen' )
          ),
          
        )
      ),

      

      

    );

    return $opts;

  }


  function media_config(){
    $config = array(
        'key'      => 'media', 
        'src'       => $this->opt('media'), 
        'html'       => $this->opt('media_html'),
        'classes'    => array('listen-media'),
        'default'    => false
      ); 

    return $config; 
  }



  function section_template(){

    

    ?>
  

    <div class="listen-wrap pl-content-area" data-bind="class: 'format-' + format()">
      <div class="listen-pad">
        
        <div class="listen-hero">

          <?php echo pl_dynamic_media( $this->media_config() ); ?>

          <div class="listen-head">
          
            <div class="listen-text">

              <h1 class="listen-header" data-bind="plshortcode: header"><?php echo $this->opt('header'); ?></h1>

              <h3 class="listen-subheader subhead" data-bind="plshortcode: subheader"><?php echo $this->opt('subheader'); ?></h3>           
              
            </div>

            <div class="listen-nav">
              <div class="listen-btns" data-bind="visible: button_primary || button_secondary">
                <a class="pl-btn" href="#" data-bind="visible: button_primary, plbtn: 'button_primary', plattr: {'target': ( button_primary_newwindow() == 1 ) ? '_blank' : ''}" ></a>
                <a class="pl-btn" href="#" data-bind="visible: button_secondary, plbtn: 'button_secondary', plattr: {'target': ( button_secondary_newwindow() == 1 ) ? '_blank' : ''}" ></a>
              
              </div>

              
            </div>
          </div>
        </div>
        
        <div class="listen-richtext" data-bind="plshortcode: text">
          <?php echo $this->opt('text'); ?>
        </div>

      </div>
    </div>
      

    <?php
  }

}
