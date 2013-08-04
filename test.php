<?php
   $file = file_get_contents('input.txt');
   $out = explode("\n", $file);
   $out_val = array();
   $file = fopen("output.txt","a");
   fwrite($file,"13696511306@163.com\r\n");
   fwrite($file,"\r\n");
   
   foreach($out as $key => $value)
   {
		$val = explode(' ', $value);
		if(count($val) == 1) continue;

		if(in_array('=', $val))
		{
			if($val[1] == 'mile') 
			{
			   $out_val['miles'] = $val[3];
			   $out_val['mile'] = $val[3];
			}
			else if($val[1] == 'yard')
			{
			   $out_val['yard'] = $val[3];
			   $out_val['yards'] = $val[3];
			}
		    else if($val[1] == 'inch')
			{
		       $out_val['inch'] = $val[3];
		       $out_val['inches'] = $val[3];
			}
			else if($val[1] == 'foot')
			{
			   $out_val['foot'] = $val[3];
			   $out_val['feet'] = $val[3];
			}
			else if($val[1] == 'fath')
			{
			    $out_val['fath'] = $val[3];
			    $out_val['faths'] = $val[3];
			}
			else if($val[1] == 'furlong')
			{
				$out_val['furlong'] = $val[3];
			}
		}
		else if(in_array('+', $val) || in_array('-', $val))
		{
			$j = trim($val[1]);
			$sum = $out_val[$j]*$val[0];		
			for($i = 1; $i <= (count($val)-2)/3; $i++)
			{
			    $j = $val[$i*3+1];
				$j = trim($j);
				$ret = $out_val[$j]*$val[$i*3];
				if($val[$i*3-1] == '+') 
				{
				   $sum = $sum+$ret;
				}
				else 
				{
				   $sum = $sum-$ret;
				}
			}
			$sum = sprintf("%.2f",$sum);
			fwrite($file,"$sum m\r\n");
			
		}
		else 
		{
			$j = trim($val[1]);
		    $sum = $out_val[$j]*$val[0];
			$sum = sprintf("%.2f",$sum);
			
			fwrite($file,"$sum m\r\n");	
		}
	}
	fclose($file);

?>