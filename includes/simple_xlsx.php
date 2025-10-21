<?php
/**
 * SimpleXLSX - A simple PHP library to read Excel files (.xlsx)
 * This implementation uses a fallback approach when ZipArchive is not available
 */

class SimpleXLSX {
    private $data = array();
    private $sharedStrings = array();
    private $worksheet = '';
    
    public function __construct($filename) {
        if (!file_exists($filename)) {
            throw new Exception('File not found: ' . $filename);
        }
        
        $this->parseXLSX($filename);
    }
    
    private function parseXLSX($filename) {
        // Check if ZipArchive is available
        if (class_exists('ZipArchive')) {
            $this->parseWithZipArchive($filename);
        } else {
            // Fallback: Try to use system unzip command
            $this->parseWithSystemUnzip($filename);
        }
    }
    
    private function parseWithZipArchive($filename) {
        $zip = new ZipArchive();
        if ($zip->open($filename) !== TRUE) {
            throw new Exception('Cannot open Excel file');
        }
        
        // Read shared strings
        $sharedStringsXML = $zip->getFromName('xl/sharedStrings.xml');
        if ($sharedStringsXML) {
            $this->parseSharedStrings($sharedStringsXML);
        }
        
        // Read worksheet data
        $worksheet = $zip->getFromName('xl/worksheets/sheet1.xml');
        if ($worksheet) {
            $this->parseWorksheet($worksheet);
        }
        
        $zip->close();
    }
    
    private function parseWithSystemUnzip($filename) {
        // Create a temporary directory
        $tempDir = sys_get_temp_dir() . '/xlsx_' . uniqid();
        if (!mkdir($tempDir, 0755, true)) {
            throw new Exception('Cannot create temporary directory');
        }
        
        try {
            // Use system unzip command
            $command = "unzip -q \"$filename\" -d \"$tempDir\"";
            $output = array();
            $returnCode = 0;
            exec($command, $output, $returnCode);
            
            if ($returnCode !== 0) {
                throw new Exception('Cannot extract Excel file');
            }
            
            // Read shared strings
            $sharedStringsFile = $tempDir . '/xl/sharedStrings.xml';
            if (file_exists($sharedStringsFile)) {
                $sharedStringsXML = file_get_contents($sharedStringsFile);
                $this->parseSharedStrings($sharedStringsXML);
            }
            
            // Read worksheet data
            $worksheetFile = $tempDir . '/xl/worksheets/sheet1.xml';
            if (file_exists($worksheetFile)) {
                $worksheetXML = file_get_contents($worksheetFile);
                $this->parseWorksheet($worksheetXML);
            }
            
        } finally {
            // Clean up temporary directory
            $this->removeDirectory($tempDir);
        }
    }
    
    private function removeDirectory($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir . "/" . $object)) {
                        $this->removeDirectory($dir . "/" . $object);
                    } else {
                        unlink($dir . "/" . $object);
                    }
                }
            }
            rmdir($dir);
        }
    }
    
    private function parseSharedStrings($xml) {
        $dom = new DOMDocument();
        $dom->loadXML($xml);
        $siNodes = $dom->getElementsByTagName('si');
        
        foreach ($siNodes as $si) {
            $tNodes = $si->getElementsByTagName('t');
            if ($tNodes->length > 0) {
                $this->sharedStrings[] = $tNodes->item(0)->nodeValue;
            }
        }
    }
    
    private function parseWorksheet($xml) {
        $dom = new DOMDocument();
        $dom->loadXML($xml);
        $rowNodes = $dom->getElementsByTagName('row');
        
        foreach ($rowNodes as $row) {
            $rowData = array();
            $cellNodes = $row->getElementsByTagName('c');
            
            foreach ($cellNodes as $cell) {
                $cellValue = '';
                $cellType = $cell->getAttribute('t');
                $vNodes = $cell->getElementsByTagName('v');
                
                if ($vNodes->length > 0) {
                    $value = $vNodes->item(0)->nodeValue;
                    
                    if ($cellType === 's') {
                        // Shared string
                        $index = intval($value);
                        if (isset($this->sharedStrings[$index])) {
                            $cellValue = $this->sharedStrings[$index];
                        }
                    } else {
                        $cellValue = $value;
                    }
                }
                
                $rowData[] = $cellValue;
            }
            
            if (!empty($rowData)) {
                $this->data[] = $rowData;
            }
        }
    }
    
    public function rows() {
        return $this->data;
    }
    
    public function rowsEx() {
        return $this->data;
    }
    
    public function dimension() {
        if (empty($this->data)) {
            return array(0, 0);
        }
        
        $maxCols = 0;
        foreach ($this->data as $row) {
            $maxCols = max($maxCols, count($row));
        }
        
        return array(count($this->data), $maxCols);
    }
}
?>
