<?php

namespace Database\Seeders;

use App\Models\Chart;
use App\Models\DataSource;
use App\Models\IndustryCluster;
use App\Models\Kpi;
use App\Models\MapMarker;
use App\Models\Page;
use App\Models\TableData;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DashboardSeeder extends Seeder
{
    public function run()
    {
        // Add Admin User
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password123'),
                'is_admin' => true,
            ]
        );

        // Regional Overview
        $regOverview = Page::create(['slug' => 'regional-overview', 'title' => 'Regional Overview']);

        Kpi::create(['page_id' => $regOverview->id, 'label' => 'Population (2024)', 'value' => '4,861,911', 'trend_value' => 'Census 2024', 'trend_direction' => 'up', 'icon' => 'trending-up', 'order' => 1]);
        Kpi::create(['page_id' => $regOverview->id, 'label' => 'Land Area', 'value' => '20,794 sq. km', 'order' => 2]);
        Kpi::create(['page_id' => $regOverview->id, 'label' => 'Density', 'value' => '370 / km²', 'order' => 3]);
        Kpi::create(['page_id' => $regOverview->id, 'label' => 'GRDP (2024)', 'value' => '₱641.76B', 'trend_value' => '4.3% Growth', 'trend_direction' => 'up', 'icon' => 'trending-up', 'order' => 4]);
        Kpi::create(['page_id' => $regOverview->id, 'label' => 'Share to PH GDP', 'value' => '2.9%', 'order' => 5]);

        Chart::create([
            'page_id' => $regOverview->id,
            'identifier' => 'grdpGrowthChart',
            'title' => 'GRDP Growth (2023 vs 2024)',
            'type' => 'bar',
            'labels' => ['2023', '2024'],
            'datasets' => [
                [
                    'label' => 'GRDP (₱ Billion)',
                    'data' => [615.3, 641.76],
                    'backgroundColor' => ['rgba(56, 189, 248, 0.2)', 'rgba(56, 189, 248, 0.8)'],
                    'borderColor' => ['rgba(56, 189, 248, 1)', 'rgba(56, 189, 248, 1)'],
                    'borderWidth' => 1,
                    'borderRadius' => 8
                ]
            ],
            'order' => 1
        ]);

        Chart::create([
            'page_id' => $regOverview->id,
            'identifier' => 'areaContributionChart',
            'title' => 'Economic Contribution by Area (2024)',
            'type' => 'doughnut',
            'labels' => ['Iloilo Province', 'Iloilo City', 'Capiz', 'Antique', 'Aklan', 'Guimaras'],
            'datasets' => [
                [
                    'data' => [34.1, 26.7, 13, 11.8, 11.5, 2.8],
                    'backgroundColor' => ['#38bdf8', '#0ea5e9', '#0284c7', '#0369a1', '#075985', '#0c4a6e'],
                    'borderColor' => 'var(--bg-dark)',
                    'borderWidth' => 2
                ]
            ],
            'order' => 2
        ]);

        $areas = [
            ['name' => "Iloilo Province", 'coords' => [11.0, 122.5], 'color' => "#38bdf8", 'data' => "<strong>Share:</strong> 34.1%<br><strong>Focus:</strong> Agriculture & Services"],
            ['name' => "Iloilo City", 'coords' => [10.7202, 122.5621], 'color' => "#0ea5e9", 'data' => "<strong>Share:</strong> 26.7%<br><strong>Growth:</strong> 7.1% (Fastest)<br><strong>Focus:</strong> Trade & Real Estate"],
            ['name' => "Aklan", 'coords' => [11.55, 122.3683], 'color' => "#075985", 'data' => "<strong>Share:</strong> 11.5%<br><strong>Focus:</strong> Tourism & Services"],
            ['name' => "Antique", 'coords' => [11.0, 122.0], 'color' => "#0369a1", 'data' => "<strong>Share:</strong> 11.8%<br><strong>Focus:</strong> Agriculture & Fishing"],
            ['name' => "Capiz", 'coords' => [11.4, 122.7], 'color' => "#0284c7", 'data' => "<strong>Share:</strong> 13.0%<br><strong>Focus:</strong> Seafood & Agriculture"],
            ['name' => "Guimaras", 'coords' => [10.5929, 122.6325], 'color' => "#0c4a6e", 'data' => "<strong>Share:</strong> 2.8%<br><strong>Status:</strong> Most Competitive Province"]
        ];
        foreach ($areas as $area) {
            MapMarker::create([
                'page_id' => $regOverview->id,
                'name' => $area['name'],
                'lat' => $area['coords'][0],
                'lng' => $area['coords'][1],
                'color' => $area['color'],
                'data' => $area['data']
            ]);
        }

        DataSource::create(['page_id' => $regOverview->id, 'title' => 'Philippine Statistics Authority (PSA)', 'url' => 'https://psa.gov.ph', 'description' => 'Primary source for Census (2024), GRDP growth rates, and regional economic accounts.', 'order' => 1]);
        DataSource::create(['page_id' => $regOverview->id, 'title' => 'DTI Region VI (Western Visayas)', 'url' => 'https://www.dti.gov.ph/regions/region-6/', 'description' => 'Source for regional investment priorities and industry cluster mappings.', 'order' => 2]);
        DataSource::create(['page_id' => $regOverview->id, 'title' => 'National Economic and Development Authority (NEDA)', 'url' => 'https://neda.gov.ph', 'description' => 'Regional development plans and macroeconomic targets for Western Visayas.', 'order' => 3]);

        // Industry Contribution
        $indContribution = Page::create(['slug' => 'industry-contribution', 'title' => 'Industry Contribution']);
        Kpi::create(['page_id' => $indContribution->id, 'label' => 'Fastest Growing Industry', 'value' => 'Professional & Business Services', 'trend_value' => '13.7%', 'trend_direction' => 'up', 'icon' => 'trending-up', 'order' => 1]);
        Kpi::create(['page_id' => $indContribution->id, 'label' => 'Second Fastest', 'value' => 'Utilities', 'trend_value' => '13.5%', 'trend_direction' => 'up', 'icon' => 'trending-up', 'order' => 2]);
        Kpi::create(['page_id' => $indContribution->id, 'label' => 'Social Work & Health', 'value' => '13.5% Growth', 'trend_value' => 'Top 3', 'trend_direction' => 'up', 'icon' => 'trending-up', 'order' => 3]);
        Kpi::create(['page_id' => $indContribution->id, 'label' => 'AFF Sector', 'value' => '-7.3% Decline', 'trend_value' => 'Area for concern', 'trend_direction' => 'down', 'icon' => 'trending-down', 'order' => 4]);

        Chart::create([
            'page_id' => $indContribution->id,
            'identifier' => 'industryShareChart',
            'title' => 'Industry Share to GDP (2023–2024)',
            'type' => 'bar',
            'labels' => ['Services', 'Industry', 'Agriculture (AFF)'],
            'datasets' => [
                ['label' => '2023', 'data' => [61.2, 23.5, 15.3], 'backgroundColor' => 'rgba(94, 163, 184, 0.4)'],
                ['label' => '2024', 'data' => [63.5, 24.1, 12.4], 'backgroundColor' => 'rgba(56, 189, 248, 0.8)']
            ],
            'order' => 1
        ]);

        Chart::create([
            'page_id' => $indContribution->id,
            'identifier' => 'industryGrowthChart',
            'title' => 'Growth Rate by Industry (2024)',
            'type' => 'bar',
            'labels' => ['Professional Services', 'Utilities', 'Health/Social Work', 'Tourism', 'Construction', 'AFF'],
            'datasets' => [['label' => 'Growth Rate (%)', 'data' => [13.7, 13.5, 13.5, 10.4, 6.8, -7.3], 'backgroundColor' => 'rgba(56, 189, 248, 0.6)', 'borderRadius' => 4]],
            'order' => 2
        ]);

        DataSource::create(['page_id' => $indContribution->id, 'title' => 'Philippine Statistics Authority (PSA)', 'url' => 'https://psa.gov.ph', 'description' => 'Core source for Industry Share to GDP and Sectoral Growth rates (2023-2024).', 'order' => 1]);
        DataSource::create(['page_id' => $indContribution->id, 'title' => 'DTI Bureau of Industrial Strategy', 'url' => 'https://www.dti.gov.ph', 'description' => 'Source for industrial performance reports and sector-specific growth analysis.', 'order' => 2]);

        // Business Profile
        $busProfile = Page::create(['slug' => 'business-profile', 'title' => 'Business Profile']);
        Kpi::create(['page_id' => $busProfile->id, 'label' => 'Total Establishments (2023)', 'value' => '85,644', 'trend_value' => '16.1% increase', 'trend_direction' => 'up', 'icon' => 'trending-up', 'order' => 1]);
        Kpi::create(['page_id' => $busProfile->id, 'label' => 'Total Employment (2023)', 'value' => '530,194', 'trend_value' => '19.3% increase', 'trend_direction' => 'up', 'icon' => 'trending-up', 'order' => 2]);
        Kpi::create(['page_id' => $busProfile->id, 'label' => 'MSME Dominance', 'value' => '99% +', 'trend_value' => 'Service sector leads (86.9%)', 'icon' => 'info', 'order' => 3]);

        Chart::create([
            'page_id' => $busProfile->id,
            'identifier' => 'bnRegistrationChart',
            'title' => 'DTI Business Name Registration (2022–2025)',
            'type' => 'line',
            'labels' => ['2022', '2023', '2024', '2025(P)'],
            'datasets' => [['label' => 'Registrations', 'data' => [65400, 71289, 68500, 72000], 'borderColor' => 'rgba(56, 189, 248, 1)', 'backgroundColor' => 'rgba(56, 189, 248, 0.1)', 'fill' => true, 'tension' => 0.4]],
            'order' => 1
        ]);

        Chart::create([
            'page_id' => $busProfile->id,
            'identifier' => 'establishmentsChart',
            'title' => 'Establishments by Province',
            'type' => 'bar',
            'labels' => ['Iloilo', 'Neg Occ', 'Aklan', 'Capiz', 'Antique', 'Guimaras'],
            'datasets' => [['label' => 'Total Establishments', 'data' => [13845, 17300, 6730, 6245, 4753, 1909], 'backgroundColor' => 'rgba(56, 189, 248, 0.6)']],
            'order' => 2
        ]);

        TableData::create([
            'page_id' => $busProfile->id,
            'identifier' => 'msme_vs_large',
            'title' => 'MSMEs vs Large Enterprises',
            'headers' => ['Province / Category', 'Micro', 'Small', 'Medium', 'Large', 'Total Count'],
            'rows' => [
                ['Iloilo', '12,450', '1,200', '150', '45', '13,845'],
                ['Negros Occidental*', '15,600', '1,450', '180', '70', '17,300'],
                ['Aklan', '6,200', '450', '60', '20', '6,730'],
                ['Capiz', '5,800', '380', '50', '15', '6,245'],
                ['Antique', '4,500', '210', '35', '8', '4,753'],
                ['Guimaras', '1,800', '95', '12', '2', '1,909'],
            ],
            'footer_note' => '*Data reflects historical inclusion in Region VI reporting structure.'
        ]);

        DataSource::create(['page_id' => $busProfile->id, 'title' => 'DTI Business Name Registration System (BNRS)', 'url' => 'https://bnrs.dti.gov.ph', 'order' => 1]);
        DataSource::create(['page_id' => $busProfile->id, 'title' => 'Philippine Statistics Authority (PSA) - ASPBI', 'url' => 'https://psa.gov.ph', 'order' => 2]);

        // Workforce & Education
        $workforce = Page::create(['slug' => 'workforce-education', 'title' => 'Workforce & Education']);
        Kpi::create(['page_id' => $workforce->id, 'label' => 'Total HEIs', 'value' => '102', 'icon' => 'info', 'order' => 1]);
        Kpi::create(['page_id' => $workforce->id, 'label' => 'Total Graduates (AY 24-25)', 'value' => '20,391', 'trend_value' => 'Strong Talent Pool', 'trend_direction' => 'up', 'icon' => 'graduation-cap', 'order' => 2]);
        Kpi::create(['page_id' => $workforce->id, 'label' => 'Public vs Private HEIs', 'value' => '46 SUCs | 49 Private', 'icon' => 'landmark', 'order' => 3]);

        Chart::create([
            'page_id' => $workforce->id,
            'identifier' => 'graduatesChart',
            'title' => 'HEI Graduates by Discipline',
            'type' => 'bar',
            'labels' => ['IT & Computing', 'Engineering/Tech', 'Business Admin', 'Medical/Allied', 'Education', 'Others'],
            'datasets' => [['label' => 'Graduates', 'data' => [4200, 3850, 5100, 4800, 2441, 0], 'backgroundColor' => 'rgba(56, 189, 248, 0.6)']],
            'order' => 1
        ]);

        Chart::create([
            'page_id' => $workforce->id,
            'identifier' => 'institutionMixChart',
            'title' => 'Institutional Mix',
            'type' => 'doughnut',
            'labels' => ['SUCs (Public)', 'Private HEIs', 'Others'],
            'datasets' => [['data' => [46, 49, 7], 'backgroundColor' => ['rgba(56, 189, 248, 0.8)', 'rgba(94, 163, 184, 0.6)', 'rgba(255, 255, 255, 0.1)'], 'borderColor' => 'var(--bg-dark)', 'borderWidth' => 2]],
            'order' => 2
        ]);

        DataSource::create(['page_id' => $workforce->id, 'title' => 'Commission on Higher Education (CHED) - RO VI', 'url' => 'https://ched.gov.ph', 'order' => 1]);
        DataSource::create(['page_id' => $workforce->id, 'title' => 'Philippine Statistics Authority (PSA) - LFS', 'url' => 'https://psa.gov.ph', 'order' => 2]);
        DataSource::create(['page_id' => $workforce->id, 'title' => 'TESDA Region VI', 'url' => 'https://www.tesda.gov.ph', 'order' => 3]);

        // Infrastructure
        $infra = Page::create(['slug' => 'infrastructure', 'title' => 'Infrastructure']);
        Kpi::create(['page_id' => $infra->id, 'label' => 'Airports', 'value' => '9', 'icon' => 'plane', 'order' => 1]);
        Kpi::create(['page_id' => $infra->id, 'label' => 'Sea Ports', 'value' => '152', 'icon' => 'ship', 'order' => 2]);
        Kpi::create(['page_id' => $infra->id, 'label' => 'Cell Towers', 'value' => '1,027', 'trend_value' => 'Connectivity', 'trend_direction' => 'up', 'icon' => 'signal', 'order' => 3]);
        Kpi::create(['page_id' => $infra->id, 'label' => 'Wi-Fi Hotspots', 'value' => '293', 'icon' => 'wifi', 'order' => 4]);

        $hubs = [
            ['name' => "Iloilo International Airport", 'coords' => [10.8290, 122.4933], 'type' => "Airport", 'color' => "#38bdf8", 'data' => "<strong>Role:</strong> Main gateway to Western Visayas.<br><strong>Status:</strong> International Hub"],
            ['name' => "Kalibo International Airport", 'coords' => [11.6783, 122.3783], 'type' => "Airport", 'color' => "#38bdf8", 'data' => "<strong>Role:</strong> Primary gateway to Boracay Island."],
            ['name' => "Roxas Airport", 'coords' => [11.5975, 122.7111], 'type' => "Airport", 'color' => "#38bdf8", 'data' => "<strong>Role:</strong> Serving Capiz and Northern Panay."],
            ['name' => "Iloilo Port", 'coords' => [10.6925, 122.5800], 'type' => "Port", 'color' => "#fbbf24", 'data' => "<strong>Role:</strong> Major hub for domestic and regional trade."],
            ['name' => "Dumangas Port", 'coords' => [10.8167, 122.7500], 'type' => "Port", 'color' => "#fbbf24", 'data' => "<strong>Role:</strong> Strategic Ro-Ro connection to Negros Island."]
        ];
        foreach ($hubs as $hub) {
            MapMarker::create([
                'page_id' => $infra->id,
                'name' => $hub['name'],
                'lat' => $hub['coords'][0],
                'lng' => $hub['coords'][1],
                'color' => $hub['color'],
                'data' => $hub['data'],
                'type' => $hub['type']
            ]);
        }

        DataSource::create(['page_id' => $infra->id, 'title' => 'Civil Aviation Authority of the Philippines (CAAP)', 'url' => 'https://www.caap.gov.ph', 'order' => 1]);
        DataSource::create(['page_id' => $infra->id, 'title' => 'Philippine Ports Authority (PPA)', 'url' => 'https://www.ppa.com.ph', 'order' => 2]);
        DataSource::create(['page_id' => $infra->id, 'title' => 'Dept. of Information and Communications Technology (DICT)', 'url' => 'https://dict.gov.ph', 'order' => 3]);

        // Priority Industries Page
        $priorityInd = Page::create(['slug' => 'priority-industries', 'title' => 'Priority Industries']);
        DataSource::create(['page_id' => $priorityInd->id, 'title' => 'DTI Region VI (Western Visayas)', 'url' => 'https://www.dti.gov.ph/regions/region-6/', 'description' => 'Source for priority industry cluster profiles, regional targets, and investment guides.', 'order' => 1]);
        DataSource::create(['page_id' => $priorityInd->id, 'title' => 'Department of Agriculture (DA) - Region VI', 'url' => 'https://westernvisayas.da.gov.ph', 'description' => 'Production data for coffee, cacao, coconut, and other high-value agricultural commodities.', 'order' => 2]);
        DataSource::create(['page_id' => $priorityInd->id, 'title' => 'Board of Investments (BOI)', 'url' => 'https://boi.gov.ph', 'description' => 'Guidelines for investment priorities plan and incentives for strategic regional projects.', 'order' => 3]);

        // Priority Industries (Clusters)
        $clusters = [
            'bamboo' => [
                'title' => "Bamboo Industry",
                'kpis' => [
                    ['label' => "Bamboo Area (2022)", 'value' => "8,450 ha", 'trend' => "Growth Area", 'icon' => "trending-up", 'status' => "up"],
                    ['label' => "MSMEs Assisted", 'value' => "156", 'trend' => "Active Support", 'icon' => "award", 'status' => "up"],
                    ['label' => "Key Product", 'value' => "Engineered", 'trend' => "Export Ready", 'icon' => "package", 'status' => ""]
                ],
                'chart' => ['labels' => ['2020', '2021', '2022', '2023', '2024'], 'data' => [6400, 7500, 8450, 9100, 9800], 'label' => "Hectares Planted"],
                'details' => [["Key Commodities", "Engineered Bamboo, Bamboo Shoots, Furniture"], ["Investment Focus", "Processing Plants, Plantation Development"], ["Target Market", "Local Construction, Export (Europe/US)"], ["Regional Status", "Strategic priority for sustainable development"]]
            ],
            'coffee' => [
                'title' => "Coffee Industry",
                'kpis' => [
                    ['label' => "Production (2024)", 'value' => "1,200 MT", 'trend' => "8% Growth", 'icon' => "trending-up", 'status' => "up"],
                    ['label' => "Coffee Farmers", 'value' => "1,850", 'trend' => "Technical Support", 'icon' => "users", 'status' => ""],
                    ['label' => "Variety", 'value' => "Robusta", 'trend' => "Main Crop", 'icon' => "coffee", 'status' => ""]
                ],
                'chart' => ['labels' => ['2020', '2021', '2022', '2023', '2024'], 'data' => [950, 1020, 1080, 1150, 1200], 'label' => "Production (Metric Tons)"],
                'details' => [["Key Commodities", "Robusta, Liberica Beans"], ["Investment Focus", "Quality Post-harvest facilities, Roasting"], ["Target Market", "Local Specialty Cafes, Institutional Buyers"], ["Status", "High priority for mountainous areas (Panay/Negros)"]]
            ],
            'cacao' => [
                'title' => "Cacao Industry",
                'kpis' => [
                    ['label' => "Production (2024)", 'value' => "580 MT", 'trend' => "15% Growth", 'icon' => "trending-up", 'status' => "up"],
                    ['label' => "Processors", 'value' => "32", 'trend' => "Award-winning", 'icon' => "award", 'status' => ""],
                    ['label' => "Area", 'value' => "1,450 ha", 'trend' => "New Plantations", 'icon' => "map", 'status' => "up"]
                ],
                'chart' => ['labels' => ['2020', '2021', '2022', '2023', '2024'], 'data' => [320, 380, 450, 520, 580], 'label' => "Production (Metric Tons)"],
                'details' => [["Key Commodities", "Fermented Beans, Tablea, Dark Chocolate"], ["Investment Focus", "Commercial-scale fermentation, Processing"], ["Target Market", "Artisanal Chocolatiers, Export Markets"], ["DTI Support", "Market linking with high-end confectioners"]]
            ],
            'fruits_nuts' => [
                'title' => "Processed Fruits & Nuts",
                'kpis' => [
                    ['label' => "Cluster MSMEs", 'value' => "482", 'trend' => "Strong Network", 'icon' => "building-2", 'status' => ""],
                    ['label' => "Export Value", 'value' => "$4.2M", 'trend' => "UP 8% YoY", 'icon' => "trending-up", 'status' => "up"],
                    ['label' => "Main Crop", 'value' => "Mango", 'trend' => "Guimaras Pride", 'icon' => "sun", 'status' => ""]
                ],
                'chart' => ['labels' => ['2020', '2021', '2022', '2023', '2024'], 'data' => [3.1, 3.4, 3.8, 4.0, 4.2], 'label' => "Export Value ($ Million)"],
                'details' => [["Key Commodities", "Dried Mango, Cashew, Pineapple"], ["Investment Focus", "Value-added processing, cold chain logistics"], ["Target Market", "Asia-Pacific, USA, Local Retail"], ["Key Hub", "Guimaras (Mango), Antique (Cashew)"]]
            ],
            'coconut' => [
                'title' => "Coconut Industry",
                'kpis' => [
                    ['label' => "Q3 2024 Production", 'value' => "136k MT", 'trend' => "Top Crop", 'icon' => "award", 'status' => "up"],
                    ['label' => "Halal Ready", 'value' => "45", 'trend' => "Establishments", 'icon' => "check-circle", 'status' => ""],
                    ['label' => "Value Addition", 'value' => "Medium", 'trend' => "Strategic Focus", 'icon' => "info", 'status' => ""]
                ],
                'chart' => ['labels' => ['2020', '2021', '2022', '2023', '2024'], 'data' => [128, 131, 133, 135, 136.5], 'label' => "Production (Thousand Metric Tons)"],
                'details' => [["Key Commodities", "Copra, Virgin Coconut Oil, Coconut Sugar"], ["Investment Focus", "High-value processing, Halal certification"], ["Target Market", "Global Wellness Market, Halal Export"], ["Status", "Foremost crop in Western Visayas in 2024"]]
            ],
            'wearables' => [
                'title' => "Wearables & Homestyle",
                'kpis' => [
                    ['label' => "Artisans Supported", 'value' => "1,200+", 'trend' => "Active Base", 'icon' => "users", 'status' => ""],
                    ['label' => "Creative Hubs", 'value' => "12", 'trend' => "Regional Hubs", 'icon' => "map-pin", 'status' => ""],
                    ['label' => "Fiber Types", 'value' => "4", 'trend' => "High Value", 'icon' => "leaf", 'status' => "up"]
                ],
                'chart' => ['labels' => ['2021', '2022', '2023', '2024', '2025(P)'], 'data' => [45, 52, 68, 75, 85], 'label' => "Assisted Creative MSMEs"],
                'details' => [["Key Commodities", "Piña Cloth, Hablon, Bamboo Wearables"], ["Investment Focus", "Design innovation, digital marketing"], ["Target Market", "High-end Fashion, Eco-conscious consumers"], ["Key Event", "Panubli-on Trade Fair"]]
            ],
            'it_bpm' => [
                'title' => "IT-BPM Sector",
                'kpis' => [
                    ['label' => "Estimated Jobs", 'value' => "45k+", 'trend' => "Rapid Expansion", 'icon' => "user-plus", 'status' => "up"],
                    ['label' => "Tech Parks", 'value' => "7", 'trend' => "PEZA Centers", 'icon' => "shield-check", 'status' => ""],
                    ['label' => "Focus", 'value' => "Next Gen", 'trend' => "AI/Analytics", 'icon' => "cpu", 'status' => "up"]
                ],
                'chart' => ['labels' => ['2020', '2021', '2022', '2023', '2024'], 'data' => [28, 32, 38, 42, 45], 'label' => "Direct Employment (Thousands)"],
                'details' => [["Key Services", "Customer Support, Software Dev, Game Dev"], ["Investment Focus", "AI optimization, creative tech"], ["Target Market", "North America, Australia, Global Tech"], ["Local Hubs", "Iloilo City (Atria Gardens, The Grid)"]]
            ]
        ];

        foreach ($clusters as $slug => $data) {
            IndustryCluster::create([
                'name' => ucfirst($slug),
                'slug' => $slug,
                'title' => $data['title'],
                'kpis' => $data['kpis'],
                'chart_data' => $data['chart'],
                'details' => $data['details']
            ]);
        }
    }
}
