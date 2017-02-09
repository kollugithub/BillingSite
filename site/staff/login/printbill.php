<?php
	session_start();
	function send_file($name) {
		  ob_end_clean();
		  $path = "bills/".$name;
		  unset($_SESSION['count']);
		  if(!is_file($path)|| connection_status()!=0) return(FALSE);
		  header("Cache-Control: no-store, no-cache, must-revalidate");
		  header("Cache-Control: post-check=0, pre-check=0", FALSE);
		  header("Pragma: no-cache");
		  
		  header("Content-Type: application/octet-stream"); /* content type "application/octet-stream" is a binary file. Typically, it will be an application or a document that must be opened in an application, such as a spreadsheet or word processor. If the attachment has a filename extension associated with it, you may be able to tell what kind of file it is. A .exe extension, for example, indicates it is a Windows or DOS program (executable), while a file ending in .doc is probably meant to be opened in Microsoft Word. */
		  header("Content-Length: ".(string)(filesize($path)));
		  header("Content-Disposition: attachment; filename=$name");
		  header("Content-Transfer-Encoding: binary\n");
		  if($file = fopen($path, 'rb')) {
			while(!feof($file) && (connection_status()==0)) {
				print(fread($file, 1024*8));
				flush();
			}
			fclose($file);
		  }
		  return((connection_status()==0) and !connection_aborted());
 	}
	$status=send_file("bill".$_SESSION['count'].".txt");
	if(!$status)
		echo "sorry,the required file can't be downloaded."; 
?>
