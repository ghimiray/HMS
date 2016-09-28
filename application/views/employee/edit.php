<div class="account-container" style="margin: 0 auto;">
	
	<div class="content clearfix">
		
		<form action="<?php echo base_url()?>employee/edit/<?php echo $employee->employee_id?>" method="post">
		
			<h1>Update Employee's Information</h1>		
			
			<div class="add-fields">

				<div class="field">
					<label for="employee_username">Username:</label>
					<input type="text" id="username" name="username" required value="<?php echo $employee->employee_username?>" placeholder="Username"/>
				</div> <!-- /field -->
				
				<div class="field">
					<label for="password">Password:</label>
					<input type="text" id="password" name="password" required value="<?php echo $employee->employee_password?>" placeholder="Password"/>
				</div> <!-- /password -->

				<div class="field">
					<label for="employee_firstname">First name:</label>
					<input type="text" id="firstname" name="firstname" required value="<?php echo $employee->employee_firstname?>" placeholder="Firstname"/>
				</div> <!-- /field -->

				<div class="field">
					<label for="employee_lastname">Last name:</label>
					<input type="text" id="lastname" name="lastname" required value="<?php echo $employee->employee_lastname?>" placeholder="Lastname"/>
				</div> <!-- /field -->

				<div class="field">
					<label for="employee_telephone">Telephone:</label>
					<input type="text" id="telephone" name="telephone" value="<?php echo $employee->employee_telephone?>" placeholder="Telephone"/>
				</div> <!-- /field -->

				<div class="field">
					<label for="employee_email">Email:</label>
					<input type="text" id="email" name="email" required value="<?php echo $employee->employee_email?>" placeholder="Email"/>
				</div> <!-- /field -->

				<div class="field">
					<label for="department_id">Department:</label>
					<select id="department_id" name="department_id" required>
					<?php
					if(isset($departments) and is_array($departments))
						foreach ($departments as $dept) {
							?>
							<option value="<?php echo $dept->department_id?>" <?php if($dept->department_id==$employee->department_id) { echo "selected"; } ?>><?php echo $dept->department_name?></option>
							<?php
						}
					?>
					</select>
				</div> <!-- /field -->

				<div class="field">
					<label for="employee_type">Employee Type:</label>
					<input type="text" id="type" name="type" required value="<?php echo $employee->employee_type?>" placeholder="Employee Type"/>
				</div> <!-- /field -->

				<div class="field">
					<label for="employee_salary">Employee Salary:</label>
					<input type="text" id="salary" name="salary" required value="<?php echo $employee->employee_salary?>" placeholder="Employee Salary"/>
				</div> <!-- /field -->

				<div class="field">
					<label for="employee_hiring_date">Employee Hiring Date:</label>
					<input type="date" id="hiring_date" name="hiring_date" required value="<?php echo $employee->employee_hiring_date?>" placeholder="Employee Hiring Date"/>
				</div> <!-- /field -->

			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				<button class="button btn btn-success btn-large">Save</button>
				
			</div> <!-- .actions -->
			
			
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->
<br>