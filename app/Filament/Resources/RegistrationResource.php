<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegistrationResource\Pages;
use App\Filament\Resources\RegistrationResource\RelationManagers;
use App\Models\Registration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RegistrationResource extends Resource
{
    protected static ?string $model = Registration::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Inscripciones';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('estudiante_id')
                ->relationship('estudiante', 'nombre')
                ->searchable()
                ->required()
                ->preload()
                ->label('Estudiante'),
                Forms\Components\Select::make('materia_id')
                    ->relationship('materia', 'nombre')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Materia'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('estudiante.nombre')->label('Estudiante'),
                Tables\Columns\TextColumn::make('materia.nombre')->label('Materia'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Fecha de inscripción'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRegistrations::route('/'),
            'create' => Pages\CreateRegistration::route('/create'),
            'edit' => Pages\EditRegistration::route('/{record}/edit'),
        ];
    }
}
