# Western Visayas Economic Dashboard - Laravel Project

This repository contains a **Laravel web application** that implements a complete dashboard for analyzing the economy, industries, business, workforce, and infrastructure of **Western Visayas**, Philippines.

The dashboard is inspired by Power BI-style reporting and provides interactive charts, tables, maps, and KPI cards for academic, research, or presentation purposes.

---
<p align="right">
  <strong>Author:</strong> Jayrold Tabalina &nbsp;&nbsp; <strong>Date:</strong> January 2026
</p>


---

## 📊 Project Overview

The dashboard provides insights into:

- Regional economy overview
- Industry contribution and growth
- Business and employment profile
- Workforce and education
- Infrastructure and connectivity
- Priority industries and investment opportunities

Data is based on official sources such as **PSA, DTI, CHED, CAAP, DICT, and NEDA**.

---

## 🗂 Dashboard Structure

### Page 1: Regional Overview (Executive Summary)

**Purpose:** Quick snapshot of Western Visayas’ economy

**Key Metrics (Cards):**
- Population (2024): 4,861,911
- Land Area: 20,794 sq. km
- Density: 370 / km²
- GRDP (2024): ₱641.76B
- Share to PH GDP: 2.9%
- Economic Growth (2024): 4.3%

**Visuals:**
- Map → Provinces (Aklan, Antique, Capiz, Guimaras, Iloilo)
- Column Chart → GRDP Growth (2023 vs 2024)
- Text section → Region profile & geography

---

### Page 2: Industry Contribution & Growth

**Visuals:**
- Stacked Column Chart → Industry Share to GDP (2023–2024)
- Bar Chart → Growth Rate by Industry (2024)

**Insights:**
- Fastest growing industries:
  - Professional & Business Services (13.7%)
  - Utilities (13.5%)
  - Health & Social Work (13.5%)
- Agriculture, Forestry, & Fishing decline (-7.3%)

**Optional Calculation (PHP logic):**
    $growthRate = ($grdp2024 - $grdp2023) / $grdp2023 * 100;

---

### Page 3: Business & Employment Profile

**Visuals:**
- Line Chart → DTI Business Name Registrations (2022–2025)
- Clustered Bar Chart → Establishments by Province
- Table → MSMEs vs Large Enterprises

**Key Figures:**
- 71,289 registrations (2023)
- 52,187 registrations (2025 YTD)
- MSMEs dominate across all provinces

---

### Page 4: Workforce & Education

**Visuals:**
- Bar Chart → HEI Graduates by Discipline

**KPI Cards:**
- 102 HEIs
- 20,391 Graduates
- 46 SUCs | 49 Private HEIs

**Focus:**
Strong supply of graduates in:
- IT
- Engineering
- Business Administration
- Medical & Allied fields

---

### Page 5: Infrastructure & Connectivity

**Visuals:**
- Map → Airports & Ports

**KPI Cards:**
- 9 Airports
- 152 Ports
- 1,027 Cell Towers
- 293 Wi-Fi Hotspots
- 20 Fiber Optic Lines

**Use Case:** Investor-readiness & logistics capacity

---

### Page 6: Priority Industries & Investment Opportunities

**Interactive Filters (Slicers):**
- Industry Cluster
- Province

**Visuals:**
- Bamboo Area Planted (2013–2022)
- Priority Commodities Table
- IT-BPM Startups Assisted (2021–2024)

**Clusters Covered:**
- Bamboo
- Coffee & Cacao
- Processed Fruits & Nuts
- Wearables & Homestyle
- IT-BPM

---

## 🗃 Data Structure

**Database Tables:**
- `region_profiles`
- `grdp_by_industry`
- `industry_growth`
- `business_registrations`
- `employment_by_province`
- `education_data`
- `infrastructure`
- `priority_industries`

**Relationships:**
- Province → Employment, Infrastructure, Priority Industries
- Year → GRDP, Growth, Registrations

---

## ⚡ Features

- Fully interactive Laravel dashboard
- Dynamic charts, tables, maps, and KPI cards
- Filter by province and industry cluster
- Trend analysis from 2013–2025
- Mobile-responsive layout

---
