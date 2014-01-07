<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CandidateTest
 *
 * @author Admin
 */
class CandidateTest extends CTestCase {
    
    
    public function testCandidate()
    {
      $candidate= new PmdCandidate();
      $this->assertInstanceof("PmdCandidate",$candidate);
    }
    
    
    
}


?>
