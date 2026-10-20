<div class="adx-root">
    @php
        $appStatusLabels = [
            'submitted' => 'Terkirim',
            'under_review' => 'Direview',
            'interview_scheduled' => 'Interview',
            'accepted' => 'Diterima',
            'rejected' => 'Ditolak',
            'cancelled' => 'Dibatalkan',
        ];
        $statusLabels = [
            'submitted' => 'Terkirim',
            'under_review' => 'Direview',
            'interview_scheduled' => 'Interview',
            'accepted' => 'Diterima',
            'rejected' => 'Ditolak',
        ];
        $profile = $application->intern->internProfile ?? null;

        $statusMeta = [
            'submitted'          => ['bg' => '#f1f5f9', 'text' => '#475569', 'border' => '#e2e8f0', 'icon' => 'send'],
            'under_review'       => ['bg' => '#eff6ff', 'text' => '#1d4ed8', 'border' => '#bfdbfe', 'icon' => 'eye'],
            'interview_scheduled'=> ['bg' => '#fffbeb', 'text' => '#b45309', 'border' => '#fde68a', 'icon' => 'calendar-event'],
            'accepted'           => ['bg' => '#ecfdf5', 'text' => '#047857', 'border' => '#a7f3d0', 'icon' => 'circle-check'],
            'rejected'           => ['bg' => '#fef2f2', 'text' => '#b91c1c', 'border' => '#fecaca', 'icon' => 'circle-x'],
            'cancelled'          => ['bg' => '#f9fafb', 'text' => '#6b7280', 'border' => '#e5e7eb', 'icon' => 'circle-dashed'],
        ];
        $sm = $statusMeta[$application->status] ?? $statusMeta['submitted'];
    @endphp

    <style>
        :root {
            --ard-primary: #3155e7;
            --ard-primary-dark: #2444c9;
            --ard-primary-light: #eef2ff;
            --ard-text: #111936;
            --ard-muted: #64708a;
            --ard-border: #e5e7eb;
            --ard-success: #16a34a;
            --ard-danger: #dc2626;
            --ard-amber: #d97706;
        }

        /* ===== BACK ===== */
        .ard-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 600;
            color: var(--ard-primary);
            text-decoration: none;
            margin-bottom: 20px;
            transition: color .15s;
        }
        .ard-back:hover { color: var(--ard-primary-dark); }
        .ard-back i { font-size: 16px; }

        /* ===== IDENTITY HEADER ===== */
        .ard-identity {
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            gap: 18px;
            background: linear-gradient(135deg, #1e2a78 0%, #2444c9 55%, #3155e7 100%);
            border: none;
            border-radius: 14px;
            color: #fff;
            padding: 24px;
            margin-bottom: 20px;
        }
        .ard-identity::after {
            content: '';
            position: absolute;
            right: -50px;
            top: -50px;
            width: 190px;
            height: 190px;
            border-radius: 50%;
            background: rgba(255,255,255,.08);
        }
        .ard-identity::before {
            content: '';
            position: absolute;
            left: 30%;
            bottom: -70px;
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: rgba(255,255,255,.05);
        }
        .ard-id-avatar {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: rgba(255,255,255,.16);
            border: 2px solid rgba(255,255,255,.4);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: 800;
            overflow: hidden;
            flex-shrink: 0;
            position: relative;
            z-index: 1;
        }
        .ard-id-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .ard-id-main { flex: 1; min-width: 0; position: relative; z-index: 1; }
        .ard-id-name {
            font-size: 18px;
            font-weight: 700;
            margin: 0 0 2px;
            line-height: 1.3;
        }
        .ard-id-email {
            font-size: 13px;
            opacity: .8;
            margin: 0 0 6px;
        }
        .ard-id-lines {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            font-size: 12px;
            opacity: .85;
        }
        .ard-id-lines i { font-size: 13px; margin-right: 3px; }
        .ard-id-badge {
            position: relative;
            z-index: 1;
            flex-shrink: 0;
        }
        .ard-id-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            background: {{ $sm['bg'] }};
            color: {{ $sm['text'] }};
            border: 1px solid {{ $sm['border'] }};
        }
        .ard-id-pill i { font-size: 14px; }

        /* ===== GRID ===== */
        .ard-grid {
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 24px;
            align-items: start;
        }
        @media (max-width: 960px) {
            .ard-grid { grid-template-columns: 1fr; }
        }

        /* ===== CARD ===== */
        .ard-card {
            background: #fff;
            border: 1px solid var(--ard-border);
            border-radius: 14px;
            padding: 22px 24px;
            margin-bottom: 20px;
        }
        .ard-card:last-child { margin-bottom: 0; }
        .ard-section-head {
            display: flex;
            align-items: center;
            gap: 9px;
            font-size: 11px;
            font-weight: 800;
            color: var(--ard-primary);
            text-transform: uppercase;
            letter-spacing: .8px;
            margin-bottom: 18px;
        }
        .ard-section-head i { font-size: 15px; }

        /* ===== DATA GRID ===== */
        .ard-data-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }
        @media (max-width: 480px) {
            .ard-data-grid { grid-template-columns: 1fr; }
        }
        .ard-data-item {
            background: #f8fafc;
            border: 1px solid var(--ard-border);
            border-radius: 12px;
            padding: 14px 16px;
        }
        .ard-data-item-wide { grid-column: span 2; }
        @media (max-width: 480px) {
            .ard-data-item-wide { grid-column: span 1; }
        }
        .ard-data-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 10px;
            font-weight: 800;
            color: var(--ard-muted);
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 5px;
        }
        .ard-data-label i { font-size: 12px; color: var(--ard-primary); }
        .ard-data-value {
            font-size: 14px;
            font-weight: 600;
            color: var(--ard-text);
            word-break: break-word;
        }
        .ard-data-empty { color: #cbd5e1; }

        /* ===== SKILLS ===== */
        .ard-skills {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 12px;
        }
        .ard-skill-tag {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            background: var(--ard-primary-light);
            color: var(--ard-primary);
        }

        /* ===== DIVIDER ===== */
        .ard-divider {
            border: none;
            border-top: 1px solid #f1f5f9;
            margin: 18px 0;
        }

        /* ===== FILES ===== */
        .ard-files {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .ard-file-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all .15s ease;
            border: 1px solid transparent;
        }
        .ard-file-btn i { font-size: 16px; }
        .ard-file-btn.is-ok {
            background: #ecfdf5;
            color: #065f46;
            border-color: #a7f3d0;
        }
        .ard-file-btn.is-ok:hover {
            background: #d1fae5;
            border-color: #6ee7b7;
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(16,185,129,.15);
        }
        .ard-file-btn.is-empty {
            background: #f9fafb;
            color: #9ca3af;
            border-color: #e5e7eb;
            cursor: default;
        }

        /* ===== FORM ===== */
        .ard-field { margin-bottom: 16px; }
        .ard-field label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 5px;
        }
        .ard-field label .req { color: #dc2626; }
        .ard-field .input,
        .ard-field select,
        .ard-field textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--ard-border);
            border-radius: 8px;
            font-size: 14px;
            color: var(--ard-text);
            background: #fff;
            transition: border-color .15s, box-shadow .15s;
            box-sizing: border-box;
        }
        .ard-field .input:focus,
        .ard-field select:focus,
        .ard-field textarea:focus {
            outline: none;
            border-color: var(--ard-primary);
            box-shadow: 0 0 0 3px rgba(49,85,231,.15);
        }
        .ard-field .input {
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        /* ===== DATE INPUT ===== */
        .ard-date-wrap {
            position: relative;
        }
        .ard-date-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--ard-muted);
            font-size: 16px;
            pointer-events: none;
            transition: color .2s ease;
        }
        .ard-date-wrap:focus-within .ard-date-icon {
            color: var(--ard-primary);
        }
        .ard-date-wrap .input {
            padding-left: 42px;
        }

        .ard-caption {
            font-size: 12px;
            color: var(--ard-muted);
            margin-top: 5px;
        }

        /* ===== BUTTONS ===== */
        .ard-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        .ard-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all .15s ease;
            border: none;
            text-decoration: none;
        }
        .ard-btn i { font-size: 15px; }
        .ard-btn-ghost {
            background: transparent;
            color: var(--ard-muted);
            border: 1px solid var(--ard-border);
        }
        .ard-btn-ghost:hover { background: #f9fafb; color: var(--ard-text); }
        .ard-btn-primary { background: var(--ard-primary); color: #fff; }
        .ard-btn-primary:hover {
            background: var(--ard-primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(49,85,231,.25);
        }
        .ard-btn-primary:disabled {
            opacity: 1;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        .ard-btn-accept { background: #059669; color: #fff; }
        .ard-btn-accept:hover {
            background: #047857;
            box-shadow: 0 4px 12px rgba(5,150,105,.25);
        }
        .ard-btn-reject { background: #dc2626; color: #fff; }
        .ard-btn-reject:hover {
            background: #b91c1c;
            box-shadow: 0 4px 12px rgba(220,38,38,.25);
        }

        /* ===== LOADING FIX ===== */
        .ard-icon-spin, .ard-txt-loading { display: none; }
        .ard-btn.is-loading .ard-icon-save   { display: none; }
        .ard-btn.is-loading .ard-icon-spin   { display: inline-block; }
        .ard-btn.is-loading .ard-txt-save    { display: none; }
        .ard-btn.is-loading .ard-txt-loading { display: inline; }
        .ard-icon-spin { animation: ard-spin 1s linear infinite; }
        @keyframes ard-spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

        /* ===== TIMELINE ===== */
        .ard-timeline { position: relative; padding-left: 28px; }
        .ard-timeline::before {
            content: '';
            position: absolute;
            left: 5px;
            top: 4px;
            bottom: 4px;
            width: 2px;
            background: #e5e7eb;
            border-radius: 2px;
        }
        .ard-tl-item { position: relative; padding-bottom: 20px; }
        .ard-tl-item:last-child { padding-bottom: 0; }
        .ard-tl-dot {
            position: absolute;
            left: -28px;
            top: 2px;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: #e5e7eb;
            border: 3px solid #fff;
            box-shadow: 0 0 0 2px #e5e7eb;
        }
        .ard-tl-dot.is-created  { background: var(--ard-primary); box-shadow: 0 0 0 2px var(--ard-primary); }
        .ard-tl-dot.is-accept  { background: var(--ard-success); box-shadow: 0 0 0 2px var(--ard-success); }
        .ard-tl-dot.is-update  { background: var(--ard-amber); box-shadow: 0 0 0 2px var(--ard-amber); }
        .ard-tl-dot.is-reject  { background: var(--ard-danger); box-shadow: 0 0 0 2px var(--ard-danger); }
        .ard-tl-item:first-child .ard-tl-dot {
            width: 16px; height: 16px; left: -29px; top: 1px;
        }
        .ard-tl-title {
            font-size: 13px;
            font-weight: 600;
            color: var(--ard-text);
            margin-bottom: 2px;
        }
        .ard-tl-change {
            font-size: 12px;
            color: #475569;
            margin-bottom: 3px;
        }
        .ard-tl-change strong { color: var(--ard-text); }
        .ard-tl-meta { font-size: 11px; color: #98a2b3; }
        .ard-tl-empty {
            text-align: center;
            padding: 30px 16px;
            color: #98a2b3;
            font-size: 13px;
        }
        .ard-tl-empty i { font-size: 28px; display: block; margin-bottom: 8px; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 640px) {
            .ard-identity { flex-direction: column; text-align: center; }
            .ard-id-badge { margin-top: 8px; }
            .ard-id-lines { justify-content: center; }
            .ard-files { flex-direction: column; }
            .ard-file-btn { width: 100%; justify-content: center; }
            .ard-actions { flex-direction: column; }
            .ard-actions .ard-btn { width: 100%; }
        }
    </style>

    {{-- ═══ HEADER ═══ --}}
    <div class="adx-header">
        <div>
            <div class="breadcrumb">
                <a href="{{ route('admin.dashboard') }}" wire:navigate>Dashboard</a>
                <i class="ti ti-chevron-right"></i>
                <a href="{{ route('admin.applications.index') }}" wire:navigate>Lamaran</a>
                <i class="ti ti-chevron-right"></i>
                <span>Review</span>
            </div>
            <h2 class="adx-title">Review Lamaran</h2>
            <p class="adx-sub">Tinjau detail lamaran dari peserta magang</p>
        </div>
    </div>

    <a href="{{ route('admin.applications.index') }}" wire:navigate class="ard-back">
        <i class="ti ti-arrow-left"></i> Kembali ke Daftar Lamaran
    </a>

    {{-- ═══ IDENTITY HEADER ═══ --}}
    <div class="ard-identity">
        <div class="ard-id-avatar">
            @if($profile && $profile->photo_url)
                <img src="{{ route('admin.applications.file', [$application->id, 'photo']) }}"
                     alt="Foto {{ $profile->full_name }}" loading="lazy">
            @else
                {{ strtoupper(substr($profile->full_name ?? $application->intern->email, 0, 1) ?? '?') }}
            @endif
        </div>
        <div class="ard-id-main">
            <h3 class="ard-id-name">{{ $profile->full_name ?? $application->intern->email }}</h3>
            <p class="ard-id-email">{{ $application->intern->email }}</p>
            <div class="ard-id-lines">
                @if($profile && $profile->institution_name)
                    <span><i class="ti ti-building"></i> {{ $profile->institution_name }}</span>
                @endif
                @if($profile && $profile->major)
                    <span><i class="ti ti-book"></i> {{ $profile->major }}</span>
                @endif
                @if($application->vacancy)
                    <span><i class="ti ti-briefcase"></i> {{ $application->vacancy->title }}</span>
                @endif
            </div>
        </div>
        <div class="ard-id-badge">
            <span class="ard-id-pill">
                <i class="ti ti-{{ $sm['icon'] }}"></i>
                {{ $appStatusLabels[$application->status] ?? ucfirst(str_replace('_', ' ', $application->status)) }}
            </span>
        </div>
    </div>

    <div class="ard-grid">
        {{-- ═══ LEFT COLUMN ═══ --}}
        <div>
            {{-- Data Pribadi --}}
            <div class="ard-card">
                <div class="ard-section-head">
                    <i class="ti ti-user"></i>
                    <span>DATA PRIBADI</span>
                </div>
                <div class="ard-data-grid">
                    <div class="ard-data-item">
                        <div class="ard-data-label"><i class="ti ti-user"></i> Nama Lengkap</div>
                        <div class="ard-data-value">{{ $profile->full_name ?? '-' }}</div>
                    </div>
                    <div class="ard-data-item">
                        <div class="ard-data-label"><i class="ti ti-gender-male"></i> Jenis Kelamin</div>
                        <div class="ard-data-value">
                            @if(($profile->gender ?? '') === 'male') Laki-laki
                            @elseif(($profile->gender ?? '') === 'female') Perempuan
                            @else <span class="ard-data-empty">—</span>
                            @endif
                        </div>
                    </div>
                    <div class="ard-data-item">
                        <div class="ard-data-label"><i class="ti ti-phone"></i> Telepon</div>
                        <div class="ard-data-value">{{ $profile->phone ?? '-' }}</div>
                    </div>
                    <div class="ard-data-item">
                        <div class="ard-data-label"><i class="ti ti-cake"></i> Tanggal Lahir</div>
                        <div class="ard-data-value">{{ $profile->date_of_birth?->format('d M Y') ?? '-' }}</div>
                    </div>
                    <div class="ard-data-item ard-data-item-wide">
                        <div class="ard-data-label"><i class="ti ti-map-pin"></i> Alamat</div>
                        <div class="ard-data-value">{{ $profile->address ?? '-' }}</div>
                    </div>
                </div>

                @if($profile && $profile->relationLoaded('skills') && $profile->skills->count())
                <div class="ard-skills">
                    @foreach($profile->skills as $skill)
                        <span class="ard-skill-tag">{{ $skill->name }}</span>
                    @endforeach
                </div>
                @endif
            </div>

            {{-- Pendidikan & Magang --}}
            <div class="ard-card">
                <div class="ard-section-head">
                    <i class="ti ti-school"></i>
                    <span>PENDIDIKAN & MAGANG</span>
                </div>
                <div class="ard-data-grid">
                    <div class="ard-data-item">
                        <div class="ard-data-label"><i class="ti ti-building"></i> Nama Institusi</div>
                        <div class="ard-data-value">{{ $profile->institution_name ?? '-' }}</div>
                    </div>
                    <div class="ard-data-item">
                        <div class="ard-data-label"><i class="ti ti-category"></i> Jenis Institusi</div>
                        <div class="ard-data-value">
                            @switch($profile->institution_type ?? '')
                                @case('university') Universitas @break
                                @case('vocational') SMK / Politeknik @break
                                @case('highschool') SMA / Sederajat @break
                                @default -
                            @endswitch
                        </div>
                    </div>
                    <div class="ard-data-item">
                        <div class="ard-data-label"><i class="ti ti-book"></i> Jurusan</div>
                        <div class="ard-data-value">{{ $profile->major ?? '-' }}</div>
                    </div>
                    <div class="ard-data-item">
                        <div class="ard-data-label"><i class="ti ti-id"></i> NIM</div>
                        <div class="ard-data-value">{{ $profile->student_id ?? '-' }}</div>
                    </div>
                    <div class="ard-data-item">
                        <div class="ard-data-label"><i class="ti ti-briefcase"></i> Lowongan</div>
                        <div class="ard-data-value">{{ $application->vacancy->title ?? '-' }}</div>
                    </div>
                    <div class="ard-data-item">
                        <div class="ard-data-label"><i class="ti ti-send"></i> Tanggal Melamar</div>
                        <div class="ard-data-value">{{ $application->applied_at?->format('d M Y') ?? '-' }}</div>
                    </div>
                </div>
            </div>

            {{-- Dokumen --}}
            <div class="ard-card">
                <div class="ard-section-head">
                    <i class="ti ti-file"></i>
                    <span>DOKUMEN</span>
                </div>
                <div class="ard-files">
                    @if($profile && $profile->cv_url)
                        <a href="{{ route('admin.applications.file', [$application->id, 'cv']) }}" target="_blank"
                           class="ard-file-btn is-ok">
                            <i class="ti ti-file-text"></i> Lihat CV
                        </a>
                    @else
                        <span class="ard-file-btn is-empty">
                            <i class="ti ti-file-x"></i> CV tidak tersedia
                        </span>
                    @endif
                    @if($profile && $profile->cover_letter_url)
                        <a href="{{ route('admin.applications.file', [$application->id, 'cover-letter']) }}" target="_blank"
                           class="ard-file-btn is-ok">
                            <i class="ti ti-mail"></i> Surat Permohonan
                        </a>
                    @else
                        <span class="ard-file-btn is-empty">
                            <i class="ti ti-mail-x"></i> Surat tidak tersedia
                        </span>
                    @endif
                    @if($profile && $profile->transcript_url)
                        <a href="{{ route('admin.applications.file', [$application->id, 'transcript']) }}" target="_blank"
                           class="ard-file-btn is-ok">
                            <i class="ti ti-school"></i> Transkrip
                        </a>
                    @else
                        <span class="ard-file-btn is-empty">
                            <i class="ti ti-school-off"></i> Transkrip tidak tersedia
                        </span>
                    @endif
                </div>
            </div>

            {{-- Ubah Status --}}
            <div class="ard-card">
                <div class="ard-section-head">
                    <i class="ti ti-refresh"></i>
                    <span>UBAH STATUS</span>
                </div>

                <div class="ard-field">
                    <label>Status Lamaran</label>
                    <select wire:model.live="reviewStatus" class="input">
                        <option value="Pilih Status Lamaran">Pilih Status Lamaran</option>
                        <option value="under_review">Under Review</option>
                        <option value="interview_scheduled">Jadwalkan Interview</option>
                        <option value="accepted">Terima</option>
                        <option value="rejected">Tolak</option>
                    </select>
                    <p class="ard-caption">
                        Status saat ini: <strong>{{ $statusLabels[$application->status] ?? ucfirst(str_replace('_', ' ', $application->status)) }}</strong>
                    </p>
                </div>

                @if($reviewStatus === 'interview_scheduled')
                <div class="ard-field">
                    <label>Tanggal Interview</label>
                    <div class="ard-date-wrap">
                        <i class="ti ti-calendar-event ard-date-icon"></i>
                        <input wire:model="interviewDate" type="datetime-local" class="input">
                    </div>
                    <p class="ard-caption">Pilih tanggal dan waktu untuk interview</p>
                </div>
                @endif

                @if($reviewStatus === 'rejected')
                <div class="ard-field">
                    <label>Alasan Penolakan <span class="req">*</span></label>
                    <textarea wire:model="rejectionReason" rows="3" class="input" placeholder="Jelaskan alasan penolakan..."></textarea>
                </div>
                @endif

                <div class="ard-field">
                    <label>Catatan Admin</label>
                    <textarea wire:model="adminNotes" rows="2" class="input" placeholder="Catatan internal (opsional)..."></textarea>
                </div>

                <div class="ard-actions">
                    <a href="{{ route('admin.applications.index') }}" wire:navigate class="ard-btn ard-btn-ghost">
                        <i class="ti ti-x"></i> Batal
                    </a>
                    <button wire:click="updateStatus"
                            wire:loading.attr="disabled"
                            wire:loading.class="is-loading"
                            wire:loading.target="updateStatus"
                            @if($reviewStatus === 'accepted') class="ard-btn ard-btn-accept"
                            @elseif($reviewStatus === 'rejected') class="ard-btn ard-btn-reject"
                            @else class="ard-btn ard-btn-primary" @endif>
                        <i class="ti ti-device-floppy ard-icon-save"></i>
                        <i class="ti ti-loader ard-icon-spin"></i>
                        <span class="ard-txt-save">Simpan Perubahan</span>
                        <span class="ard-txt-loading">Menyimpan...</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- ═══ RIGHT COLUMN: RIWAYAT ═══ --}}
        <div>
            <div class="ard-card" style="position:sticky;top:24px">
                <div class="ard-section-head">
                    <i class="ti ti-history"></i>
                    <span>RIWAYAT PERUBAHAN</span>
                </div>

                @if($auditLogs->isEmpty())
                    <div class="ard-tl-empty">
                        <i class="ti ti-clock-off"></i>
                        Belum ada riwayat perubahan
                    </div>
                @else
                    <div class="ard-timeline">
                        @foreach($auditLogs as $log)
                            @php
                                $oldStatus = $log->old_values['status'] ?? null;
                                $newStatus = $log->new_values['status'] ?? null;
                                $dotClass = 'is-update';
                                if ($log->action === 'created') $dotClass = 'is-created';
                                elseif ($newStatus === 'accepted') $dotClass = 'is-accept';
                                elseif ($newStatus === 'rejected') $dotClass = 'is-reject';
                            @endphp
                            <div class="ard-tl-item">
                                <div class="ard-tl-dot {{ $dotClass }}"></div>
                                <div class="ard-tl-title">
                                    @if($log->action === 'created')
                                        Lamaran dibuat
                                    @elseif($oldStatus && $newStatus && $oldStatus !== $newStatus)
                                        Status: {{ $statusLabels[$oldStatus] ?? ucfirst(str_replace('_', ' ', $oldStatus)) }} → {{ $statusLabels[$newStatus] ?? ucfirst(str_replace('_', ' ', $newStatus)) }}
                                    @elseif($log->action === 'updated')
                                        Data diperbarui
                                    @else
                                        {{ ucfirst($log->action) }}
                                    @endif
                                </div>
                                @if($log->action === 'updated' && $log->new_values)
                                    @php $fv = collect($log->new_values)->except(['updated_at', 'created_at']); @endphp
                                    @if($fv->isNotEmpty())
                                        <div class="ard-tl-change">
                                            @foreach($fv as $k => $v)
                                                <strong>{{ ucfirst(str_replace('_', ' ', $k)) }}</strong>: {{ is_array($v) ? json_encode($v) : $v }}{{ $loop->last ? '' : '<br>' }}
                                            @endforeach
                                        </div>
                                    @endif
                                @endif
                                <div class="ard-tl-meta">
                                    {{ $log->created_at->isoFormat('D MMMM Y, HH:mm') }}
                                    @if($log->user)
                                        · {{ $log->user->displayName() }}
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
