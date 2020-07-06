<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<div style="float:right">
	<h2>
		<button class="btn btn-primary" onClick="window.location.href='<?=site_url()?>/Transaksi/P_transaksi_generate_bill/add'">
			<i class="fa fa-plus"></i>
			Tambah
		</button>
		<button class="btn btn-warning" onClick="window.history.back()" disabled>
			<i class="fa fa-arrow-left"></i>
			Back
		</button>
		<button class="btn btn-success" onClick="window.location.href='<?=site_url()?>/Transaksi/P_transaksi_generate_bill'">
			<i class="fa fa-repeat"></i>
			Refresh
		</button>
	</h2>
</div>
<div class="clearfix"></div>
</div>
<div class="x_content">
	<div class="row">
		<div class="col-sm-12">
			<div class="card-box table-responsive">
				<table class="table table-striped jambo_table bulk_action tableDT">
					<thead>
						<tr>
							<th>No</th>
							<th>Kawasan</th>
							<th>Blok</th>
							<th>Unit</th>
							<th>Pemilik</th>
							<th>Total Tagihan</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
                            $i = 0;
                            foreach ($data as $key => $v){
                                $i++;
                                echo('<tr>');
                                    echo("<td>$i</td>");
                                    echo("<td>$v->kawasan</td>");
                                    echo("<td>$v->blok</td>");
                                    echo("<td>$v->no_unit</td>");
                                    echo("<td>$v->customer</td>");
                                    echo("<td>$v->periode</td>");
                                    echo("
                                        <td>
                                        <a href='".site_url()."/Transaksi/P_transaksi_generate_bill/edit?id=$v->id' class='btn btn-primary col-md-10'>
                                            <i class='fa fa-pencil'></i>
                                        </a>
                                        </td>
                                    ");
                                echo('</td></tr>');                
                            }
                        ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>
</div>
