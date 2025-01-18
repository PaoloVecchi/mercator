<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // default seeder
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
        ]);
        // Test data seeder
        if (env("USE_DEMO_DATA", false)) {
            // Do not seed these tables
            // $this->call(DemoMigrationsTableSeeder::class);
            // $this->call(DemoOauthAuthCodesTableSeeder::class);
            // $this->call(DemoOauthAccessTokensTableSeeder::class);
            // $this->call(DemoOauthRefreshTokensTableSeeder::class);
            // $this->call(DemoOauthClientsTableSeeder::class);
            // $this->call(DemoOauthPersonalAccessClientsTableSeeder::class);
            // $this->call(DemoPasswordResetsTableSeeder::class);
            $this->call(DemoApplicationBlocksTableSeeder::class);
            $this->call(DemoOperationsTableSeeder::class);
            $this->call(DemoActorsTableSeeder::class);
            $this->call(DemoActorOperationTableSeeder::class);
            $this->call(DemoZoneAdminsTableSeeder::class);
            $this->call(DemoAnnuairesTableSeeder::class);
            $this->call(DemoApplicationServicesTableSeeder::class);
            $this->call(DemoApplicationModulesTableSeeder::class);
            $this->call(DemoAuditLogsTableSeeder::class);
            $this->call(DemoSitesTableSeeder::class);
            $this->call(DemoBuildingsTableSeeder::class);
            $this->call(DemoBaysTableSeeder::class);
            $this->call(DemoDhcpServersTableSeeder::class);
            $this->call(DemoFluxesTableSeeder::class);
            $this->call(DemoForestAdsTableSeeder::class);
            $this->call(DemoLansTableSeeder::class);
            $this->call(DemoGatewaysTableSeeder::class);
            $this->call(DemoMansTableSeeder::class);
            $this->call(DemoMediaTableSeeder::class);
            $this->call(DemoLogicalServersTableSeeder::class);
            $this->call(DemoNetworkSwitchesTableSeeder::class);
            $this->call(DemoPeripheralsTableSeeder::class);
            $this->call(DemoNetworksTableSeeder::class);
            $this->call(DemoPhysicalSecurityDevicesTableSeeder::class);
            $this->call(DemoRoutersTableSeeder::class);
            $this->call(DemoEntitiesTableSeeder::class);
            $this->call(DemoRelationsTableSeeder::class);
            $this->call(DemoTasksTableSeeder::class);
            $this->call(DemoVlansTableSeeder::class);
            $this->call(DemoWansTableSeeder::class);
            $this->call(DemoMacroProcessusesTableSeeder::class);
            $this->call(DemoProcessesTableSeeder::class);
            $this->call(DemoCertificatesTableSeeder::class);
            $this->call(DemoMApplicationsTableSeeder::class);
            $this->call(DemoInformationTableSeeder::class);
            $this->call(DemoDatabasesTableSeeder::class);
            $this->call(DemoSubnetworksTableSeeder::class);
            $this->call(DemoDnsserversTableSeeder::class);
            $this->call(DemoExternalConnectedEntitiesTableSeeder::class);
            $this->call(DemoWorkstationsTableSeeder::class);
            $this->call(DemoActivitiesTableSeeder::class);
            $this->call(DemoPhysicalServersTableSeeder::class);
            $this->call(DemoStorageDevicesTableSeeder::class);
            $this->call(DemoDataProcessingTableSeeder::class);
            $this->call(DemoSecurityControlsTableSeeder::class);
            $this->call(DemoPhysicalSwitchesTableSeeder::class);
            $this->call(DemoPhysicalRoutersTableSeeder::class);
            $this->call(DemoWifiTerminalsTableSeeder::class);
            $this->call(DemoPhonesTableSeeder::class);
            $this->call(DemoSecurityDevicesTableSeeder::class);
            $this->call(DemoPhysicalLinksTableSeeder::class);
            $this->call(DemoApplicationModuleApplicationServiceTableSeeder::class);
            $this->call(DemoApplicationServiceMApplicationTableSeeder::class);
            $this->call(DemoBayWifiTerminalTableSeeder::class);
            $this->call(DemoDatabaseInformationTableSeeder::class);
            $this->call(DemoDatabaseMApplicationTableSeeder::class);
            $this->call(DemoEntityMApplicationTableSeeder::class);
            $this->call(DemoDomaineAdsTableSeeder::class);
            $this->call(DemoEntityProcessTableSeeder::class);
            $this->call(DemoInformationProcessTableSeeder::class);
            $this->call(DemoLanWanTableSeeder::class);
            $this->call(DemoLogicalServerPhysicalServerTableSeeder::class);
            $this->call(DemoMApplicationProcessTableSeeder::class);
            $this->call(DemoManWanTableSeeder::class);
            $this->call(DemoOperationTaskTableSeeder::class);
            $this->call(DemoPhysicalRouterVlanTableSeeder::class);
            $this->call(DemoActivityOperationTableSeeder::class);
            $this->call(DemoDatabaseEntityTableSeeder::class);
            $this->call(DemoDomaineAdForestAdTableSeeder::class);
            $this->call(DemoLanManTableSeeder::class);
            $this->call(DemoLogicalServerMApplicationTableSeeder::class);
            $this->call(DemoCertificateMApplicationTableSeeder::class);
            $this->call(DemoCertificateLogicalServerTableSeeder::class);
            $this->call(DemoCartographerMApplicationTableSeeder::class);
            $this->call(DemoMApplicationEventsTableSeeder::class);
            $this->call(DemoMApplicationWorkstationTableSeeder::class);
            $this->call(DemoDatabaseLogicalServerTableSeeder::class);
            // $this->call(DemoCpeVendorsTableSeeder::class);
            // $this->call(DemoCpeProductsTableSeeder::class);
            $this->call(DemoActivityProcessTableSeeder::class);
            $this->call(DemoActivityDocumentTableSeeder::class);
            $this->call(DemoDocumentsTableSeeder::class);
            $this->call(DemoEntityDocumentTableSeeder::class);
            $this->call(DemoCpeVersionsTableSeeder::class);
            $this->call(DemoSecurityControlProcessTableSeeder::class);
            $this->call(DemoSecurityControlMApplicationTableSeeder::class);
            $this->call(DemoDataProcessingInformationTableSeeder::class);
            $this->call(DemoDataProcessingMApplicationTableSeeder::class);
            $this->call(DemoDataProcessingProcessTableSeeder::class);
            $this->call(PermissionRoleTableSeeder::class);
    }
    }
}
