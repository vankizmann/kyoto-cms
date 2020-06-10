<?php

namespace Kyoto\Application;

use Kyoto\Support\Instance\InstanceElement;

class KyotoInstance extends InstanceElement
{
    use Plugins\InstallerPlugin;
    use Plugins\LanguagePlugin;
    use Plugins\CollectionPlugin;
    use Plugins\RoutingPlugin;
    use Plugins\MenuPlugin;
}
