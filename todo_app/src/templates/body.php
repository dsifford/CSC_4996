<?php
/**
 * Main app functionality
 *
 * @package TodoApp
 */

defined( 'TODO_APP_LOADED' ) || exit;

/**
 * Renders hidden input fields for a given action.
 *
 * @param string $action The action of the form.
 */
function render_hidden_fields( string $action ): void {
	// phpcs:disable
	?>
	<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
	<input type="hidden" name="action" value="<?php echo $action; ?>">
	<?php
	// phpcs:enable
}

?>
<body>
	<section class="section" role="main">
		<div class="container">
			<div class="panel">
				<h1 class="panel-heading">Todo list</h1>
				<form class="panel-block" action="todos.php" method="post">
					<?php render_hidden_fields( Actions::ADD_TODO ); ?>
					<input class="input" type="text" name="todo" placeholder="Add todo..." autofocus required>
				</form>
				<div class="panel-tabs">
					<a href="/" class="<?php echo ! in_array( $_GET['filter'], [ 'active', 'completed' ], true ) ? 'is-active' : ''; ?>">All</a>
					<a href="/?filter=active" class="<?php echo $_GET['filter'] === 'active' ? 'is-active' : ''; ?>">Active</a>
					<a href="/?filter=completed" class="<?php echo $_GET['filter'] === 'completed' ? 'is-active' : ''; ?>">Completed</a>
				</div>
				<?php foreach ( $db->get_todos( $_GET['filter'] ) as $todo ) : ?>
					<div class="panel-block">
						<div class="columns is-gapless is-vcentered" style="width: 100%;">
							<?php if ( $todo->status === 'completed' ) : ?>
								<form class="column is-1" style="width: auto;" action="todos.php" method="post">
									<?php render_hidden_fields( Actions::TOGGLE_TODO ); ?>
									<button class="button has-text-grey-light" style="border: none;" name="id" value="<?php echo strip_tags( $todo->id ); ?>">
										<i class="material-icons">
											check_box
										</i>
									</button>
								</form>
								<div class="column is-italic has-text-grey-light">
									<del><?php echo strip_tags( $todo->content ); ?></del>
								</div>
							<?php else : ?>
								<form class="column is-1" style="width: auto;" action="todos.php" method="post">
									<?php render_hidden_fields( Actions::TOGGLE_TODO ); ?>
									<button class="button" style="border: none;" name="id" value="<?php echo strip_tags( $todo->id ); ?>">
										<i class="material-icons">
											check_box_outline_blank
										</i>
									</button>
								</form>
								<div class="column">
									<?php echo strip_tags( $todo->content ); ?>
								</div>
							<?php endif; ?>
							<form class="column is-1" style="line-height: 1; width: auto;" action="todos.php" method="post">
								<?php render_hidden_fields( Actions::DELETE_TODO ); ?>
								<button class="delete" title="Delete todo" name="id" value="<?php echo strip_tags( $todo->id ); ?>">Delete</button>
							</form>
						</div>
					</div>
				<?php endforeach; ?>
				<form class="panel-block" style="justify-content: flex-end;" action="todos.php" method="post">
					<?php render_hidden_fields( Actions::CLEAR_COMPLETED ); ?>
					<button class="button">Clear completed</button>
				</form>
			</div>
		</div>
	</section>
</body>
