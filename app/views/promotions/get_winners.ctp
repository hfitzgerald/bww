<?php if($week == false): ?>



		<h1>Week does not exist!</h1>
<?php else: ?>


<div id="week_info">

    <h1 id="week_number">Week <?php echo $week['Week']['week_number'] ; ?></h1>      

    <span><strong>Start Date:</strong> <?php echo $week['Week']['start_date']; ?></span>
    
    <br />

    <span><strong>End Date:</strong> <?php echo $week['Week']['end_date']; ?></span>

</div>


<?php $nav_url = '/admin/week/'; ?>



<div id="leaderboards">

    <div id="top_users">

            <h2>Top Users</h2>

            <table id="top_users_table" class="leaderboard_table">

                     <thead>
							
                            <th>Position</th>

                            <th>id</th>

                            <th>Name</th>

                            <th>Total Points</th>

                     </thead>

                     <tbody>
								<?php $count=0; ?>
                            <?php foreach($users as $user): ?>
								<?php $count+=1;
								if($count >= 11){break;}
								
								 ?>
                                    <tr>

                                            <td align='center'><?php echo $count; ?></td>

                                            <td><?php echo $user['User']['id']; ?></td>

                                            <td><?php echo $user['User']['name']; ?></td>

                                             <td align='center'><?php echo $user['WeeklyUserTotal']['points']; ?></td>

                                    </tr>

                            <?php endforeach; ?>

                     </tbody>

            </table>

    </div>


    <div id="top_locations">

            <h2>Top Locations</h2>

            <table id="top_locations_table" class="leaderboard_table">

                    <thead>


							 <th>position</th>
				 
                            <th>id</th>

                          

                            <th>City</th>

                            <th>State</th>

                          

                            

                            <th>Total Points</th>

                    </thead>

                    <tbody>
								<?php $location_count = 0; ?>
                            <?php foreach($locations as $location): ?>
								<?php $location_count+=1;
									if($location_count >= 11){break;}
								  ?>
                                    <tr>
											  <td align='center'><?php echo $location_count ?></td>
											
                                            <td><?php echo $location['Location']['id']; ?></td>

                                          

                                            <td><?php if(isset($location['Location']['city'])) echo $location['Location']['city']; ?></td>

                                            <td><?php if(isset($location['Location']['state'])) echo $location['Location']['state']; ?></td>

                                          

                                          
                                            <td align='center'><?php echo $location['WeeklyLocationTotal']['points']; ?></td>

                                    </tr>

                            <?php endforeach; ?>

                    </tbody>

            </table>

    </div>

    

    


</div>


<?php endif ?>