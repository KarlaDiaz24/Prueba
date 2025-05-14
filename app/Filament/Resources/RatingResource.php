<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RatingResource\Pages;
use App\Filament\Resources\RatingResource\RelationManagers;
use App\Models\Rating;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class RatingResource extends Resource
{
    protected static ?string $model = Rating::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Calificaciones';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('inscripcion_id')
                    ->relationship('inscripcion', 'id')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->estudiante?->nombre ?? 'Sin nombre')
                    ->searchable()
                    ->required()
                    ->preload()
                    ->label('Estudiante'),
                Forms\Components\TextInput::make('calificacion')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->required()
                    ->label('Calificación'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('inscripcion.estudiante.nombre')->label('Estudiante'),
                Tables\Columns\TextColumn::make('inscripcion.materia.nombre')->label('Materia'),
                Tables\Columns\TextColumn::make('calificacion')->label('Calificación'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Fecha'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    public static function shouldRegisterNavigation(): bool
        {
            return Auth::check();
        }
    public static function getEloquentQuery(): Builder
        {
            $query = parent::getEloquentQuery();
            $user = Auth::user();

            if ($user && $user->role === 'docente') {
                return $query->whereHas('inscripcion.materia', function ($q) use ($user) {
                    $q->where('docente_id', $user->id);
                });
            }

            return $query;
        }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRatings::route('/'),
            'create' => Pages\CreateRating::route('/create'),
            'edit' => Pages\EditRating::route('/{record}/edit'),
        ];
    }
}
