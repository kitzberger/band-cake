<div class="large-9 medium-8 columns dashboard">
    <?php $this->assign('title', 'Dashboard') ?>

    <?php if ($currentUser) { ?>
    <h1>Dashboard</h1>

    <p>Hallo <em><?= $currentUser['username'] ?></em>, here's your update!</p>

    <table>
        <tr>
            <td>
                <h3>Upcoming shows</h3>
                <table>
                <?php
                    foreach ($dates as $date) {
                        echo '<tr>';
                        echo '<td>' . $this->Html->link($date->title, ['controller' => 'Dates', 'action' => 'view', $date->id]) . '</td>';
                        echo '<td class="date no-wrap">' . h($date->begin->format('D, d.m.Y')) . '</td>';
                        echo '<td>' . $this->element('Dates/status', ['date' => $date]) . '</td>';
                        echo '</tr>';
                    }
                ?>
                </table>
                <?= $this->Html->link(__('All dates'), ['controller' => 'Dates', 'action' => 'index']); ?>
            </td>
            <td>
                <h3>Latest song updates</h3>
                <table>
                <?php
                    foreach ($songs as $song) {
                        echo '<tr>';
                        echo '<td>' . $this->Html->link($song->title, ['controller' => 'Songs', 'action' => 'view', $song->id]) . '</td>';
                        echo '<td>' . ($song->text ? $this->Html->link('<i class="fi-page"></i>', ['controller' => 'Songs', 'action' => 'display', $song->id], ['escape' => false]) : '') . '</td>';
                        echo '</tr>';
                    }
                ?>
                </table>
                <?= $this->Html->link(__('All songs'), ['controller' => 'Songs', 'action' => 'index']); ?>
            </td>
        </tr>
        <tr>
            <td>
                <h3>Latest collection updates</h3>
                <table>
                <?php
                    foreach ($collections as $collection) {
                        echo '<tr>';
                        echo '<td>' . $this->Html->link($collection->title, ['controller' => 'Collections', 'action' => 'view', $collection->id]) . '</td>';
                        echo '<td>' . count($collection->files) ?> / <?= count($collection->songs) . '</td>';
                        echo '</tr>';
                    }
                ?>
                </table>
                <?= $this->Html->link(__('All collections'), ['controller' => 'Collections', 'action' => 'index']); ?>
            </td>
            <td>
                <h3>Latest idea updates</h3>
                <table>
                <?php
                    foreach ($ideas as $idea) {
                        echo '<tr>';
                        echo '<td>' . $this->Html->link($idea->title, ['controller' => 'Ideas', 'action' => 'view', $idea->id]) . '</td>';
                        echo '<td>' . count($idea->comments) . '</td>';
                        echo '</tr>';
                    }
                ?>
                </table>
                <?= $this->Html->link(__('All ideas'), ['controller' => 'Ideas', 'action' => 'index']); ?>
            </td>
        </tr>
    </table>
    <?php } ?>
</div>
