<?php
/***************************************
 *** Home Background Slider Extension ***
 ***************************************
 *
 * @copyright   Copyright (c) 2015
 * @company     NetAttingo Technologies
 * @package     Netgo_Slider
 * @author 		Vipin
 * @dev			77vips@gmail.com
 *
 */
class Netgo_Slider_Controller_Adminhtml_Slider
    extends Mage_Adminhtml_Controller_Action {
    /**
     * upload file and get the uploaded name
     * @access public
     * @param string $input
     * @param string $destinationFolder
     * @param array $data
     * @return string
     * @author Vipin
     */
    protected function _uploadAndGetName($input, $destinationFolder, $data) {
        try{
            if (isset($data[$input]['delete'])){
                return '';
            }
            else{
                $uploader = new Varien_File_Uploader($input);
                $uploader->setAllowRenameFiles(true);
                $uploader->setFilesDispersion(true);
                $uploader->setAllowCreateFolders(true);
                $result = $uploader->save($destinationFolder);
                return $result['file'];
            }
        }
        catch (Exception $e) {
            if ($e->getCode() != Varien_File_Uploader::TMP_NAME_EMPTY) {
                throw $e;
            }
            else{
                if (isset($data[$input]['value'])){
                    return $data[$input]['value'];
                }
            }
        }
        return '';
    }
}
